<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;



class AdminController extends Controller
{
    //

    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }


    public function settings()
    {
        Session::put('page','settings');
        //way-1
        // echo "<pre>"; print_r(Auth::guard('admin')->user());die;
        //way -2
        $adminDetails = Admin :: where('email',Auth::guard('admin')->user()->email)->first();
        //dd($adminDetails);
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }



    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;

           $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required',
           ];
           $custom_message =[
               'email.required' => 'Email address is required',
               'email.email' =>'Valid Email is required',
               'password.required' => 'Password is required',
           ];

           $this->validate($request,$rules,$custom_message);


           if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']]))
           {
               return redirect('admin/dashboard');
           }
           else {
               Session::flash('error_message','Invalid email Or Password');
               return redirect()->back();
           }
        }
        return view('admin.admin_login');
    }

    public function logout(){
       Auth::guard('admin')->logout();
       return redirect('/admin');
    }

    public function chkCurrentPassword(Request $request){
        $data = $request->all();
       // echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
            //if true then check ajex in admin_script.js file is password currect
        }else{
            echo "false";
         //if false then check ajex in admin_script.js file is password currect
        }
    }

    public function updateCurrentPassword(Request $request){
        if($request->isMethod("post")){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           // check if password is currect
           if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
               //check is new and confirm password is matching
               if($data['new_pwd'] == $data['confirm_pwd']){
                   Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                   Session::flash('success_message','Password has been updated succesfully!');

               }else{
                Session::flash('error_message','Your new and confirm password does not match');
               }
             }else{
                 Session::flash('error_message','Your current password is incurrect');
             }
             return redirect()->back();
          }
      }


      public function updateAdminDetails(Request $request)
      {
        Session::put('page','update-admin-details');
          if($request->isMethod('post')){
              $data = $request->all();
             // echo "<pre>"; print_r($data); die;
             $rules = [
                 'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                 'admin_mobile' => 'required|numeric',
                // 'admin_image' => 'image'
             ];
             $custom_message = [
                 'admin_name.required' => 'Admin name is required',
                 'admin_name.regex' => 'Valid Admin name is required',
                 'admin_mobile.required' => 'Mobile number is required',
                 'admin_mobile.numeric' =>'Valid Mobile number is required',
                // 'admin_image.image' => 'Valid image is required'
             ];
             $this->validate($request,$rules,$custom_message);

             // Upload Image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->resize(400,400)->save($imagePath);
                }
            }else if(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            }else{
                $imageName = "";
            }

             //update Admin Details
             Admin::where('email',Auth::guard('admin')->user()->email)
             ->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
             Session::flash('success_message','Admin details updated successfully');
             return redirect()->back();
          }
          return view('admin.updateAdminDetails');
      }
}
