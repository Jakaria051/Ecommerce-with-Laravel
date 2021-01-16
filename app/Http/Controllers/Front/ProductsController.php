<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listing($url,Request $request)
    {
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

                $categoryProducts = $categoryProducts->paginate(30);
                return view('front.products.ajax_product_listing',compact('categoryDetails','categoryProducts','url'));

            }
            else
            {
                abort(404);
            }


        }
        else
        {
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount > 0)
            {
                //echo "Category exists"; die;
                $categoryDetails = Category::catDetails($url);

                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])
                ->where('status',1);
                $categoryProducts = $categoryProducts->paginate(30);

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
}
