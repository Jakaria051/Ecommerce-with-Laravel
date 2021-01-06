<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listing($url)
    {
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount > 0)
        {
            //echo "Category exists"; die;
            $categoryDetails = Category::catDetails($url);

            $categoryProducts = Product::whereIn('category_id',$categoryDetails['catIds'])
            ->where('status',1)->get()->toArray();
            // echo "<pre>";
            // print_r($categoryDetails);
            // echo "<pre>";
            // print_r($categoryProducts); die;


            return view('front.products.listing',compact('categoryDetails','categoryProducts'));

        }
        else
        {
            abort(404);
        }
    }
}
