<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $page_name = "index";

        $featuredItemsCount = Product::where('is_featured','Yes')->where('status',1)->count();
        $featuredItems = Product::where('is_featured','Yes')->where('status',1)->get()->toArray();
       // $featuredItemsChunk = array_chunk($featuredItems,4);
       //latest product
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(4)->get()->toArray();
        return view('front.index',compact('page_name','featuredItems','featuredItemsCount','newProducts'));
    }
}
