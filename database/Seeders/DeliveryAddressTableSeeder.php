<?php

namespace Database\Seeders;

use App\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            [
                'id'=>1,'user_id'=>1,'name'=>'Jakaria','address'=>'Test 123',
                'city'=>'Sylhet','state'=>'Sadar','country'=>'Bangladesh',
                'pincode'=>12323,'mobile'=>794597345935,'status'=>1
            ],

            [
                'id'=>2,'user_id'=>1,'name'=>'Jakaria','address'=>'ee 134',
                'city'=>'Sylhet','state'=>'Sadar','country'=>'Bangladesh',
                'pincode'=>23,'mobile'=>794597345935,'status'=>1
            ],
        ];

        DeliveryAddress::insert($deliveryRecords);
    }
}
