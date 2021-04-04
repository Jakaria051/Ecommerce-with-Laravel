<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use App\User;
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
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status',1)->get()->toArray();
        return view('admin.orders.order_details',compact('orderDetails','userDetails','orderStatuses'));
    }

    public function updateOrderStatus(Request $request)
    {
        $data = $request->all();
        Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
        Session::put('success_message','Order Status has been updated successfully');
        return redirect()->back();
    }
}
