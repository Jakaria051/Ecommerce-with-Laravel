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

        $featuredItemsCount = Product::where('is_featured','Yes')->count();
        $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
      //  $featuredItemsChunk = array_chunk($featuredItems,4);
        return view('front.index',compact('page_name','featuredItems','featuredItemsCount'));
    }
}
