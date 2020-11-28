<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function products() {
        Session::put('page','products');
     $products = Product::with(['category'=> function($query){
          $query->select('id','category_name');
      },'section'=>function($query) {
          $query->select('id','name');
      } ])->get();
        return view('admin.products.products',compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Product::where('id',$data['product_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id) {
        Product::where('id',$id)->delete();
        $message = "Product has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function addEditProduct(Request $request,$id=null) {
        if($id == "") {
            $title = "Add Product";
        }else {
            $title = "Edit Product";
        }

        //Filter Arrays
        $fabricArray = array('Cotton','Polyester','Wool');
        $sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeeveless');
        $PatternArray = array('Checked','Plain','Printed','Self','Solid');
        $fitArray = array('Regular','Slim');
        $occasionArray = array('Casual','Formal');

        //Section with categories & sub categories
       $categories = Section::with('categories')->get();
       $categories = json_decode(json_encode($categories),true);

        return view('admin.products.add_edit_product',compact('title','categories','fabricArray','sleeveArray','PatternArray','fitArray','occasionArray'));
    }
}
