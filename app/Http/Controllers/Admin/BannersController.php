<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class BannersController extends Controller
{
    public function banners()
    {
        Session::put('page','banners');
        $banners = Banner::get()->toArray();
       // dd($banners); die;
       return view('admin.banners.banners',compact('banners'));
    }

    public function addEditBanner($id = null,Request $request)
    {
        if($id == null)
        {
            $bannerdata = new Banner;
            $title = "Add Banner";
            $message = "Banner added successfully";
        }
        else
        {
            $bannerdata = Banner::find($id);
            $title = "Edit Banner";
            $message = "Banner updated successfully";
        }
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $bannerdata->link = $data['link'];
            $bannerdata->title = $data['title'];
            $bannerdata->alt = $data['alt'];

            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $image_name = $image_tmp->getClientOriginalName();
                    $extention = $image_tmp->getClientOriginalExtension();
                    $imageName = $image_name.'-'.rand(111,99999).'.'.time().'.'.$extention;
                    $image_path = 'images/banner_images/'.$imageName;
                    //resize
                    Image::make($image_tmp)->resize(1170,480)->save($image_path);
                    $bannerdata->image = $imageName;
                }
            }
            $bannerdata->save();
            return redirect()->back()->with('success_message',$message);

        }
        return view('admin.banners.add_edit_banner',compact('title','bannerdata'));
    }

    public function updateBannerStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
        $bannerImage = Banner::where('id',$id)->first();
        $bannerImagePath = 'images/banner_images/';
        if(file_exists($bannerImagePath.$bannerImage->image))
        {
            unlink($bannerImagePath.$bannerImage->image);
        }

        Banner::where('id',$id)->delete();
        $message = "Banner image has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
