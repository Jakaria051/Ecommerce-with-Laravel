<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponsController extends Controller
{
    public function coupons()
    {
        Session::put('page','coupons');
        $coupons = Coupon::get()->toArray();
        return view('admin.coupons.coupons',compact('coupons'));
    }


    public function updateCouponStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'coupon_id'=>$data['coupon_id']]);
        }
    }

    public function addEditCoupon($id = null)
    {
        if($id=="")
        {
            $coupondata = new Coupon();
            $title = "Add Coupon";
        }else{
            $coupondata = Coupon::find($id);
            $title = "Edit Coupon";
        }

        //Section with categories & sub categories
       $categories = Section::with('categories')->get();
       $categories = json_decode(json_encode($categories),true);
        return view('admin.coupons.add_edit_coupons',compact('coupondata','title','categories'));

    }
}
