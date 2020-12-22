<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page','brands');
        $brands = Brand::get();
        return view('admin.brands.brands',compact('brands'));
    }

    public function updateBrandsStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }

    public function addEditBrand(Request $request,$id=null)
    {
        if($id == "")
        {
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand added successfully";
        }
        else
        {
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $message = "Brand updated successfully";
        }

        if($request->isMethod('post'))
        {
            $data = $request->all();
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];
            $custom_message = [
                'brand_name.required' => 'Brand name is required',
                'brand_name.regex' => 'Valid brand name is required'
            ];
            $this->validate($request,$rules,$custom_message);

            $brand->name = $data['brand_name'];
            $brand->status = 1;
            $brand->save();

            return redirect()->back()->with('success_message',$message);
        }

        return view('admin.brands.add_edit_brand',compact('title','brand'));
    }

    public function deleteBrand($id){
        Brand::where('id',$id)->delete();
        $message = "Brand has been deleted successfully!";
        Session::flash('success_message',$message);
        return redirect()->back();
    }
}
