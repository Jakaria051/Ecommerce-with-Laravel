<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function orders()
    {
        Session::put('page','orders');
        $orders = Order::with('order_products')->orderBy('id','desc')->get()->toArray();
        return view('admin.orders.orders',compact('orders'));
    }

    public function orderDetails($id)
    {
        $orderDetails = Order::with('order_products')->where('id',$id)->first()->toArray();
        return view('admin.orders.order_details',compact('orderDetails'));
    }
}
