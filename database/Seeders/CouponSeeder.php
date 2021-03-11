<?php

namespace Database\Seeders;

use App\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->truncate();
        $couponRecords = [
            'coupon_option'=>'Manual','coupon_code'=>'test10','categories'=>'1,2',
            'users'=>'jakariacse35@gmail.com,jacjakaria51@gmail.com','coupon_type'=>'single',
            'amount_type'=>'Percentage','amount'=>'10','expiry_date'=>'2021-05-15','status'=>1
        ];

        Coupon::insert($couponRecords);
    }
}
