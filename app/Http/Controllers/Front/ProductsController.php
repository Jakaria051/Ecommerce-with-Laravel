<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        Paginator::useBootstrap();

        if($request->ajax())
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $url = $data['url'];
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount > 0)
            {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])
                ->where('status',1);
                //If fabric filter is selected
                if(isset($data['fabric']) && !empty($data['fabric']))
                {
                    $categoryProducts->whereIn('products.fabric',$data['fabric']);
                }
                //If sleeve filter is selected
                if(isset($data['sleeve']) && !empty($data['sleeve']))
                {
                    $categoryProducts->whereIn('products.sleeve',$data['sleeve']);
                }
                //If pattern filter is selected
                if(isset($data['pattern']) && !empty($data['pattern']))
                {
                    $categoryProducts->whereIn('products.pattern',$data['pattern']);
                }
                //If fit filter is selected
                if(isset($data['fit']) && !empty($data['fit']))
                {
                    $categoryProducts->whereIn('products.fit',$data['fit']);
                }
                //If occation filter is selected
                if(isset($data['occasion']) && !empty($data['occasion']))
                {
                    $categoryProducts->whereIn('products.occasion',$data['occasion']);
                }
                //If sort is selected by user
                if(isset($data['sort']) && !empty($data['sort']))
                {
                    if($data['sort'] == "product_latest")
                    {
                        $categoryProducts->orderBy('id','desc');
                    }
                        else if($data['sort'] == "product_name_a_z")
                        {
                            $categoryProducts->orderBy('product_name','Asc');

                        }
                        else if($data['sort'] == "product_name_z_a")
                        {
                            $categoryProducts->orderBy('product_name','Desc');
                        }
                        else if($data['sort'] == "price_lowest")
                        {
                            $categoryProducts->orderBy('product_price','Asc');
                        }
                        else if($data['sort'] == "price_highest")
                        {
                            $categoryProducts->orderBy('product_price','Desc');
                        }
                    else
                    {
                        $categoryProducts->orderBy('id','desc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(3);
                return view('front.products.ajax_product_listing',compact('categoryDetails','categoryProducts','url'));

            }
            else
            {
                abort(404);
            }


        }
        else
        {
             $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount > 0)
            {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);

                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])
                ->where('status',1);
                $categoryProducts = $categoryProducts->paginate(3);

                //Filter Arrays
                $productFilters = Product::productFilters();
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $PatternArray = $productFilters['PatternArray'];
                $fitArray = $productFilters['fitArray'];
                $occasionArray = $productFilters['occasionArray'];

                $page_name = "listing";

                return view('front.products.listing',compact('categoryDetails','categoryProducts','url','fabricArray','sleeveArray','PatternArray','fitArray','occasionArray','page_name'));
            }else{
                abort(404);
            }



        }
    }

    public function detail($id)
    {
        $productDetails = Product::with(['category','brand','attributes'=>function($query){
            $query->where('status',1);
        },'images'])->find($id)->toArray();
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        $relatedProducts = Product::where('category_id',$productDetails['category']['id'])->where('id','<>',$id)->limit(3)->inRandomOrder()->get()->toArray();
        // dd($relatedProducts);
        return view('front.products.detail',compact('productDetails','total_stock','relatedProducts'));
    }

    public function getProductPrice(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            $getDiscountAttrPrice = Product::getDiscountAttrPrice($data['product_id'],$data['size']);
            return $getDiscountAttrPrice;

        }
    }

    public function addToCart(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
           //check product stock is available or not
           $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
           if($getProductStock['stock'] < $data['quantity'])
           {
               $message = "Required quantity is not avaiable";
               return redirect()->back()->with('error_message',$message);
            }

            //Generate Session ID if not exists
            $session_id = Session::get('session_id');
            if(empty($session_id))
            {
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }

            // check product if already exists in user cart
            if(Auth::check())
            {
                $countProduct = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
            }else
            {
                $countProduct = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
            }

            if($countProduct > 0)
            {

                    $message = "Product is already exists in your cart";
                    Session::flash('error_message',$message);
                    return redirect()->back();
            }

            $cart = new Cart();
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product has been added in your cart";
            Session::flash('success_message',$message);
            return redirect('cart');
        }

    }

    public function cart()
    {
        $userCartItems = Cart::userCartItems();
       // dd($userCartItems);
        return view('front.products.cart',compact('userCartItems'));
    }

    public function updateCartItemQty(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Cart::where('id',$data['cardid'])->update(['quantity'=>$data['qty']]);
            $userCartItems = Cart::userCartItems();
            return response()->json(['view'=>(String)View::make('front.products.cart_item',compact('userCartItems'))]);
        }
    }
}
