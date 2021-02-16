<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function registerUser(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount > 0)
            {
                $message = "Email alredy exists";
                Session::flash('error_message',$message);
                return redirect()->back();
            }else
            {
                $user = new User();
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
                {
                    return redirect('t-shirts');
                }

            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
