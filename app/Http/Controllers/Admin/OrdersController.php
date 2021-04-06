<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrdersLog;
use App\OrderStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $orderLog = OrdersLog::where('order_id',$id)->orderBy('id','Desc')->get()->toArray();
        return view('admin.orders.order_details',compact('orderDetails','userDetails','orderStatuses','orderLog'));
    }

    public function updateOrderStatus(Request $request)
    {
        $data = $request->all();
        Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
        Session::put('success_message','Order Status has been updated successfully');

        ///update courier name & tracking number
        if(!empty($data['courier_name']) && !empty($data['tracking_number'])) {
            Order::where('id',$data['order_id'])->update(['courier_name'=>$data['courier_name'],'tracking_number'=>$data['tracking_number']]);
        }
        //send mail
        $deliveryDetails = Order::select('mobile','email','name')->where('id',$data['order_id'])->first()->toArray();
        $orderDetails = Order::with('order_products')->where('id', $data['order_id'])->first()->toArray();
       // $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $email = $deliveryDetails['email'];
        $messageData = [
            'email' => $email,
            'name' => $deliveryDetails['name'],
            'order_id' => $data['order_id'],
            'order_status'=>$data['order_status'],
            'courier_name'=>$data['courier_name'],
            'tracking_number'=>$data['tracking_number'],
            'orderDetails' => $orderDetails,
        ];

        Mail::send('emails.order_status', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Order Status Update');
        });

        //update order log
        $log = new OrdersLog();
        $log->order_id = $data['order_id'];
        $log->order_status = $data['order_status'];
        $log->save();

        return redirect()->back();
    }

    public function viewOrderInvoice($id)
    {
        $orderDetails = Order::with('order_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        return view('admin.orders.order_invoice',compact('orderDetails','userDetails'));
    }
}
