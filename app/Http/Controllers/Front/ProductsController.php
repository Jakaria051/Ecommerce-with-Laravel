<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Category;
use App\Coupon;
use App\DeliveryAddress;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrdersProduct;
use App\Product;
use App\ProductsAttribute;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        Paginator::useBootstrap();

        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);
                //If fabric filter is selected
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }
                //If sleeve filter is selected
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }
                //If pattern filter is selected
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }
                //If fit filter is selected
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }
                //If occation filter is selected
                if (isset($data['occasion']) && !empty($data['occasion'])) {
                    $categoryProducts->whereIn('products.occasion', $data['occasion']);
                }
                //If sort is selected by user
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == "product_latest") {
                        $categoryProducts->orderBy('id', 'desc');
                    } else if ($data['sort'] == "product_name_a_z") {
                        $categoryProducts->orderBy('product_name', 'Asc');

                    } else if ($data['sort'] == "product_name_z_a") {
                        $categoryProducts->orderBy('product_name', 'Desc');
                    } else if ($data['sort'] == "price_lowest") {
                        $categoryProducts->orderBy('product_price', 'Asc');
                    } else if ($data['sort'] == "price_highest") {
                        $categoryProducts->orderBy('product_price', 'Desc');
                    } else {
                        $categoryProducts->orderBy('id', 'desc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(3);
                return view('front.products.ajax_product_listing', compact('categoryDetails', 'categoryProducts', 'url'));

            } else {
                abort(404);
            }

        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);

                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);
                $categoryProducts = $categoryProducts->paginate(3);

                //Filter Arrays
                $productFilters = Product::productFilters();
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $PatternArray = $productFilters['PatternArray'];
                $fitArray = $productFilters['fitArray'];
                $occasionArray = $productFilters['occasionArray'];

                $page_name = "listing";

                return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'url', 'fabricArray', 'sleeveArray', 'PatternArray', 'fitArray', 'occasionArray', 'page_name'));
            } else {
                abort(404);
            }

        }
    }

    public function detail($id)
    {
        $productDetails = Product::with(['category', 'brand', 'attributes' => function ($query) {
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();
        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::where('category_id', $productDetails['category']['id'])->where('id', '<>', $id)->limit(3)->inRandomOrder()->get()->toArray();
        // dd($relatedProducts);
        return view('front.products.detail', compact('productDetails', 'total_stock', 'relatedProducts'));
    }

    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getDiscountAttrPrice = Product::getDiscountAttrPrice($data['product_id'], $data['size']);
            return $getDiscountAttrPrice;

        }
    }

    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //check product stock is available or not
            $getProductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();
            if ($getProductStock['stock'] < $data['quantity']) {
                $message = "Required quantity is not avaiable";
                return redirect()->back()->with('error_message', $message);
            }

            //Generate Session ID if not exists
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // check product if already exists in user cart
            if (Auth::check()) {
                $countProduct = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
            } else {
                $countProduct = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
            }

            if ($countProduct > 0) {

                $message = "Product is already exists in your cart";
                Session::flash('error_message', $message);
                return redirect()->back();
            }

            if (Auth::check()) {
                $user_id = Auth::id();
            } else {
                $user_id = 0;
            }

            $cart = new Cart();
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product has been added in your cart";
            Session::flash('success_message', $message);
            return redirect('cart');
        }

    }

    public function cart()
    {
        $userCartItems = Cart::userCartItems();
        // dd($userCartItems);
        return view('front.products.cart', compact('userCartItems'));
    }

    public function updateCartItemQty(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Get Cart details
            $cartDetails = Cart::find($data['cardid']);
            //Get Available product stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();
            //check stock is available or not
            if ($data['qty'] > $availableStock['stock']) {
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product stock is not available',
                    'view' => (String) View::make('front.products.cart_item', compact('userCartItems')),
                ]);
            }

            //check size is available or not
            $availableSize = ProductsAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();
            if ($availableSize == 0) {
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                return response()->json([
                    'status' => false,
                    'totalCartItems' => $totalCartItems,
                    'message' => 'Product size is not available',
                    'view' => (String) View::make('front.products.cart_item', compact('userCartItems')),
                ]);
            }

            Cart::where('id', $data['cardid'])->update(['quantity' => $data['qty']]);
            $userCartItems = Cart::userCartItems();
            return response()->json([
                'status' => true,
                'view' => (String) View::make('front.products.cart_item', compact('userCartItems')),
            ]);
        }
    }

    //delete cart item
    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cardid'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (String) View::make('front.products.cart_item', compact('userCartItems')),
            ]);
        }
    }

    public function applyCoupon(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            $couponCount = Coupon::where('coupon_code',$data['code'])->count();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            if($couponCount == 0) {
                return response()->json(['status'=>false,'message'=>'The coupon is not valid',
                'totalCartItems' => $totalCartItems,
                'view'=>(String)View::make('front.products.cart_item',compact('userCartItems'))]);
            }else{

                //get coupon details
                $couponDetails = Coupon::where('coupon_code',$data['code'])->first();
                //check if it is acive or inactive
                if($couponDetails->status == 0) {
                    $message = "The coupon is not active";
                }

                //check coupon is expired
                $expiry_date = $couponDetails->expiry_date;
                $current_day = date('Y-m-d');
                if($expiry_date < $current_day)
                {
                    $message = "The coupon is expired";
                }
                //check is product from selected coupon categories
                $catArr = explode(",",$couponDetails->categories);

                //check selected users for coupon

                if(!empty($couponDetails->users)) {
                    $userArr = explode(",",$couponDetails->users);
                    foreach($userArr as $key => $user) {
                        $getUserID = User::select('id')->where('email',$user)->first()->toArray();
                        $userID[] = $getUserID['id'];
                    }
                }


                $total_amount = 0;
                foreach($userCartItems as $key => $item) {

                    if(!in_array($item['product']['category_id'],$catArr)){
                        $message = "The Coupon code is not for you. which you selected";
                    }

                    if(!empty($couponDetails->users)) {
                    if(!in_array($item['user_id'],$userID)) {
                        $message = "The Coupon Code is not for you";
                    }
                   }
                    $attrPrice = Product::getDiscountAttrPrice($item['product_id'],$item['size']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);

                }
                if(isset($message)) {
                    return response()->json(['status'=>false,'message'=>$message,
                    'totalCartItems' => $totalCartItems,
                    'view'=>(String) View::make('front.products.cart_item',compact('userCartItems'))
                    ]);
                }else{
                    if($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    }else {
                        $couponAmount = $total_amount * ($couponDetails->amount/100);
                    }

                    $grand_total = $total_amount - $couponAmount;
                    Session::put('couponAmount',$couponAmount);
                    Session::put('couponCode',$data['code']);
                    $message = "Coupon code is successfully applied.you are now availing discount";
                    return response()->json(['status'=>true,
                    'message'=>$message,
                    'totalCartItems' => $totalCartItems,
                    'couponAmount' => $couponAmount,
                    'grand_total' => $grand_total,
                    'view'=>(String)View::make('front.products.cart_item',compact('userCartItems'))]);
                }

            }
        }
    }


    public function checkout(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['address_id'])) {
                $message = "Please Select delivery address";
                Session::flash('error_message', $message);
                return redirect()->back();
            }
            if(empty($data['payment_gateway'])) {
                $message = "Please select delivery method";
                Session::flash('error_message', $message);
                return redirect()->back();
            }
          // echo Session::get('grand_total');
             if($data['payment_gateway'] == "COD") {
                 $payment_method = "COD";
             }else {
                 $payment_method = "Prepaid";
             }

             //Get delivery address from addressId

             $deliveryAddress = DeliveryAddress::where('id',$data['address_id'])->first()->toArray();
             //Insert Order details
            DB::beginTransaction();
             $order = new Order();
             $order->user_id = Auth::id();
             $order->name = $deliveryAddress['name'];
             $order->address = $deliveryAddress['address'];
             $order->city = $deliveryAddress['city'];
             $order->state = $deliveryAddress['state'];
             $order->country = $deliveryAddress['country'];
             $order->pincode = $deliveryAddress['pincode'];
             $order->mobile = $deliveryAddress['mobile'];
             $order->email = Auth::user()->email;
             $order->shipping_charges = 0;
             $order->coupon_code = Session::get('couponCode');
             $order->coupon_amount = Session::get('couponAmount');
             $order->order_status = "New";
             $order->payment_method = $payment_method;
             $order->payment_gateway = $data['payment_gateway'];
             $order->grand_total = Session::get('grand_total');
             $order->save();

             //last id
             $order_id = DB::getPdo()->lastInsertId();

             $cartItms = Cart::where('user_id',Auth::id())->get()->toArray();
             foreach($cartItms as $key => $item) {
                 $cartItem = new OrdersProduct();
                 $cartItem->order_id = $order_id;
                 $cartItem->user_id = Auth::id();

                 $getProductDetails = Product::select('product_code','product_name',
                 'product_color')->where('id',$item['product_id'])->first()->toArray();

                 $cartItem->product_id = $item['product_id'];
                 $cartItem->product_code = $getProductDetails['product_code'];
                 $cartItem->product_name = $getProductDetails['product_name'];
                 $cartItem->product_color = $getProductDetails['product_color'];
                 $cartItem->product_size = $item['size'];

                 $getDiscountedPrice = Product::getDiscountAttrPrice($item['product_id'],$item['size']);

                 $cartItem->product_price = $getDiscountedPrice['final_price'];
                 $cartItem->product_qty = $item['quantity'];

                 $cartItem->save();
             }

             Cart::where('user_id',Auth::id())->delete();

             Session::put('order_id',$order_id);

             DB::commit();

             if($data['payment_gateway'] == "COD") {
                 //Send order details by mail
                 $message = "Dear Customer,your order".$order_id."has been successfully
                 placed.we will intimate you once your is shipped";

                 $orderDetails = Order::with('order_products')->where('id',$order_id)->first()->toArray();
                 $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
                 $email = Auth::user()->email;
                 $messageData = [
                     'email'=>$email,
                     'name'=>Auth::user()->name,
                     'order_id'=>$order_id,
                     'orderDetails' => $orderDetails
                 ];

                 Mail::send('emails.order', $messageData, function ($message) use($email) {
                     $message->to($email)->subject('Order Placed');
                 });
                return redirect('/thanks');
            }else {
                echo "Payment Method comming soon...";
                die;
            }





        }
        $userCartItems = Cart::userCartItems();
        if(count($userCartItems) == 0) {
            $message = "Shopping cart is empty! Please add products to checkout.";
            Session::put('error_message',$message);
            return redirect('cart');
        }
        $deliveryAddressses = DeliveryAddress::deliveryAddressses();
        return view('front.products.checkout',compact('userCartItems','deliveryAddressses'));
    }


    public function addEditDeliveryAddress($id = null, Request $request) {
        if($id == "") {
            $title = "Add Delivery Address";
            $address = new DeliveryAddress();
            $message = "Address Added Successfully";
        }else {
            $title = "Edit Delivery Address";
            $message = "Address Updated Successfully";
        }

        $countries = [
            "Bangladesh","Nepal","India"
        ];

        if($request->isMethod('post'))
        {
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric|digits:10',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'pincode' => 'required',
                'state' => 'required',
               // 'image' => 'image'
            ];
            $custom_message = [
                'name.required' => 'name is required',
                'name.regex' => 'Valid name is required',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' =>'Valid Mobile number is required',
               // 'image.image' => 'Valid image is required'
            ];
            $this->validate($request,$rules,$custom_message);

            $address->user_id = Auth::id();
            $address->name = $data['name'];
            $address->address = $data['address'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->country = $data['country'];
            $address->pincode = $data['pincode'];
            $address->mobile = $data['mobile'];
            $address->status = 1;
            $address->save();
            Session::put('success_message', $message);
            return redirect('checkout');


        }

        return view('front.products.add_edit_delivery_address',compact('countries','title','address'));
    }


    public function thanksPage() {
        if(Session::has('order_id')) {
            return view('front.products.thanks');
        }else {
            return redirect('/cart');
        }
    }
}
