<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


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

    public function addEditCoupon(Request $request,$id = null)
    {
        if($id=="")
        {
            $coupondata = new Coupon();
            $title = "Add Coupon";
            $selCats = array();
            $selUsers = array();
            $message = "Coupon has been added";
        }else{
            $coupondata = Coupon::find($id);
            $title = "Edit Coupon";
            $selCats = explode(",",$coupondata['categories']);
            $selUsers = explode(",",$coupondata['users']);
            $message = "Coupon has been updated";
        }

        if($request->isMethod('post'))
        {
            $data = $request->all();

            $rules = [
                'coupon_option' => 'required',
                'categories' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required',
                'expiry_date' => 'required',
            ];
            $custom_message = [
                'coupon_option.required' => 'Coupon option field is required',
                'categories.required' => 'Category filed is required',
                'coupon_type.required' => 'Coupon type field is required',
                'amount_type.required' => 'Amount type field is required',
                'amount.required' => 'Amount field is required',
                'expiry_date.required' => 'expiry date field is required',
            ];

            $this->validate($request,$rules,$custom_message);

            if(isset($data['users'])) {
                $users = implode(",",$data['users']);
            }
            if(isset($data['categories'])) {
                $categories = implode(",",$data['categories']);
            }
            if($data['coupon_option'] == "Automatic")
            {
                $coupon_code = Str::random(8);
            }else {
                $coupon_code = $data['coupon_code'];
            }
            $coupondata->coupon_option = $data['coupon_option'];
            $coupondata->coupon_code = $coupon_code;
            $coupondata->categories = $categories;
            if(isset($users) && !empty($users)) {
            $coupondata->users = $users;
            }else{
                $coupondata->users = null;
            }
            $coupondata->coupon_type = $data['coupon_type'];
            $coupondata->amount_type = $data['amount_type'];
            $coupondata->amount = $data['amount'];
            $coupondata->expiry_date = $data['expiry_date'];
            $coupondata->status = 1;
            $coupondata->save();

            Session::flash('success_message', $message);
            return redirect('admin/coupons');

        }

        //Section with categories & sub categories
       $categories = Section::with('categories')->get();
       $categories = json_decode(json_encode($categories),true);
       $users = User::select('email')->where('status',1)->get()->toArray();
        return view('admin.coupons.add_edit_coupons',compact('coupondata','title','categories','users','selUsers','selCats'));

    }


    public function deleteCoupon($id) {
        Coupon::where('id',$id)->delete();
        $message = "Coupon has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
