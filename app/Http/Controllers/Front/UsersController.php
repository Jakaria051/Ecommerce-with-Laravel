<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class UsersController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                $message = "Email alredy exists";
                Session::flash('error_message', $message);
                return redirect()->back();
            } else {
                $user = new User();
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->save();

                //Send Confirmation Mail
                $email = $data['email'];
                $messageData = [
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'code' => base64_encode($data['email'])
                ];

                Mail::send('emails.confirmation',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Confirm your e-commerce account');
                });

                $message = "Please confirm your email to activate your account";
                Session::put('success_message',$message);
                return redirect()->back();

                // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

                //     //update user cart
                //     if (!empty(Session::get('session_id'))) {
                //         $user_id = Auth::id();
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                //     }
                //     ///send email
                //     $email = $data['email'];
                //     $messageData = ['name' => $data['name'], 'email' => $data['email'], 'mobile' => $data['mobile']];
                //     Mail::send('emails.register_template', $messageData, function ($message) use ($email) {
                //         $message->to($email)->subject("Welcome to E-commerce Site");
                //     });

                //     return redirect('t-shirts');
                // }

            }
        }
    }

    public function confirmAccount($email)
    {
        Session::forget('error_message');
            Session::forget('success_message');
      $email = base64_decode($email);

      $userCount = User::where('email',$email)->count();
      if($userCount > 0)
      {
          $userDetails = User::where('email',$email)->first();
          if($userDetails->status == 1){
              $message = "Your Email account is already activated.Please login.";
              Session::put('error_message',$message);
              return redirect('login-register');
          }else{
              User::where('email',$email)->update(['status'=>1]);
              $messageData = ['name' => $userDetails['name'], 'email' => $email, 'mobile' => $userDetails['mobile']];
              Mail::send('emails.register_template', $messageData, function ($message) use ($email) {
                $message->to($email)->subject("Welcome to E-commerce Site");
             });

             $message = "Your Email account is activated.Please login.";
             Session::put('success_message',$message);
             return redirect('login-register');
          }
      }
    }


    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if ($emailCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    ////////////////////////Login ////////////////////////////

    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
               //check email is activate or not
               $userStatus = User::where('email',$data['email'])->first();
               if($userStatus->status == 0)
               {
                   Auth::logout();
                   $message = "Your account is not activated yet! Please confirm your mail to activate";
                   Session::put('error_message',$message);
                   return redirect()->back();
               }


                //update user cart
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::id();
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }
                return redirect('/cart');
            } else {
                $message = "Invalid username or password";
                Session::flash('error_message', $message);
                return redirect()->back();
            }
        }
    }

    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $emailCount = User::where('email',$data['email'])->count();
            if($emailCount == 0)
            {
                $message = "Email does not exits";
                Session::put('error_message',$message);
                Session::forget('success_message');
                return redirect()->back();
            }else
            {
                $random_password = Str::random(8);
                $new_password = bcrypt($random_password);
                User::where('email',$data['email'])->update(['password'=>$new_password]);
                $user_name = User::select('name')->where('email',$data['email'])->first();
                $email = $data['email'];
                $name = $user_name->name;
                $messageData = [
                    'email' => $email,
                    'name'=>$name,
                    'password'=>$random_password
                ];

                Mail::send('emails.forget_password',$messageData,function($message) use ($email){
                    $message->to($email)->subject('New Password - E-commerce Website');
                });

                $message = "Please check your email for new password";
                Session::put('success_message',$message);
                Session::forget('error_message');
                return redirect('login-register');

            }
        }
        return view('front.users.forget_password');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}
