<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;



class AdminController extends Controller
{
    //

    public function dashboard(){

        return view('admin.admin_dashboard');
    }


    public function settings()
    {
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
}
