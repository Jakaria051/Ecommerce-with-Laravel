<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function orders()
    {
        $orders = Order::with('order_products')->where('user_id',Auth::id())->orderBy('id','Desc')->get()->toArray();
        return view('front.orders.orders',compact('orders'));
    }

    public function orderDetails($id)
    {
        $orderDetails = Order::with('order_products')->where('id',$id)->first()->toArray();
        return view('front.orders.order_details',compact('orderDetails'));
    }
}
