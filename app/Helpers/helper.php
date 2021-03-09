<?php

use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function totalCartItems()
{
    if(Auth::check())
    {
        $user_id = Auth::id();
        $totalCartItems = Cart::where(['user_id'=>$user_id])->sum('quantity');
    }else{
        $session_id = Session::get('session_id');
        $totalCartItems = Cart::where(['session_id'=>$session_id])->sum('quantity');
    }
    return $totalCartItems;
}
