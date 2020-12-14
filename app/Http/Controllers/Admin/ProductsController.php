<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use App\ProductsAttribute;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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
            $product = new Product;
            $productdata = array();
            $message = "Product added successfully";
        }else {
            $title = "Edit Product";
            $productdata = Product::find($id);
            $productdata = json_decode(json_encode($productdata),true);
            $product = Product::find($id);
            $message = "Product updated successfully";

        }

        if($request->isMethod('post')) {
              $data = $request->all();

             $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $custom_message = [
                'category_id.required' => 'Product is required',
                'product_name.required' => 'Product name is required',
                'product_name.regex' => 'Valid Product name is required',
                'product_code.required' => 'Product code is required',
                'product_code.regex' => 'Valid Product code is required',
                'product_price.required' => 'Product price is required',
                'product_color.required' => 'Product color is required',
                'product_color.regex' => 'Valid Product color is required',
            ];
            $this->validate($request,$rules,$custom_message);

            if(empty($data['is_featured'])) {
                $is_featured = "No";
            }else{
                $is_featured = "Yes";
            }

            if(empty($data['product_discount'])) {
                $data['product_discount'] = 0.00;
            }
            if(empty($data['product_weight'])) {
                $data['product_weight'] = 0.00;
            }

            if(empty($data['description'])) {
                $data['description'] = "";
            }

            if(empty($data['wash_care'])) {
                $data['wash_care'] = "";
            }

            if(empty($data['fabric'])) {
                $data['fabric'] = "";
            }
            if(empty($data['pattern'])) {
                $data['pattern'] = "";
            }
            if(empty($data['sleeve'])) {
                $data['sleeve'] = "";
            }
            if(empty($data['fit'])) {
                $data['fit'] = "";
            }
            if(empty($data['occasion'])) {
                $data['occasion'] = "";
            }
            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            //upload product image
            if($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()){
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
					//rename
                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;
                    Image::make($image_tmp)->save($large_image_path); //w-1040 H-1200
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    $product->main_image = $imageName;

                }
            }
            //upload product video
            if($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()) {
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand().'.'.$extension;
                    $video_path = 'videos/product_videos';
                    $video_tmp->move($video_path,$videoName);
                    $product->product_video = $videoName;
                }
            }

            //Save the products details in products table

            $categoryDetails = Product::findOrFail($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $is_featured;
            $product->status = 1;
            $product->save();

            Session::flash('success_message',$message);
            return redirect('admin/products');

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

        return view('admin.products.add_edit_product',compact('title','productdata','categories',
        'fabricArray','sleeveArray','PatternArray','fitArray','occasionArray'));
    }


    public function deleteProductImage($id) {
        $productImage = Product::select('main_image')->where('id',$id)->first();
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        //delete small Product image from folder
        if(file_exists($small_image_path.$productImage->main_image)) {
            unlink($small_image_path.$productImage->main_image);
        }

        //delete medium Product image from folder
        if(file_exists($medium_image_path.$productImage->main_image)) {
            unlink($medium_image_path.$productImage->main_image);
        }

        //delete large Product image from folder
        if(file_exists($large_image_path.$productImage->main_image)) {
            unlink($large_image_path.$productImage->main_image);
        }

        Product::where('id',$id)->update(['main_image'=>'']);
        $message = "Product Image has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }


    public function deleteProductVideo($id) {
        $productVideo = Product::select('product_video')->where('id',$id)->first();
        $product_video_path = 'videos/product_videos/';
        //delete category from folder
        if(file_exists($product_video_path.$productVideo->product_video)) {
            unlink($product_video_path.$productVideo->product_video);
        }

        Product::where('id',$id)->update(['product_video'=>'']);
        $message = "Product Video has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function addAttributes(Request $request, $id) {
        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['sku'] as $key => $value) {
                if(!empty($value)) {
                    //Check sku already exist or not
                    $attributeCountSKU = ProductsAttribute::where('sku',$value)->count();
                    if($attributeCountSKU > 0) {
                        $message = "SKU already exist.Please add another SKU!";
                        return redirect()->back()->with('error_message',$message);
                    }

                    //Check size already exist or not
                    $attributeCountSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attributeCountSize > 0) {
                        $message = "Size already exist.Please add another Size!";
                        return redirect()->back()->with('error_message',$message);
                    }
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }

            $message = "Product attributes has been added successfully!";
            return redirect()->back()->with('success_message',$message);
        }
        $productdata = Product::select('id','product_name','product_code','product_color','main_image')->with('attributes')->find($id);
        $productdata = json_decode(json_encode($productdata),true);
        $title = "Product Attributes";
        return view('admin.products.add_attributes',compact('productdata','title'));
    }


}
