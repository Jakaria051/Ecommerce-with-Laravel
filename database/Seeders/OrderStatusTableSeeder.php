<?php

namespace Database\Seeders;

use App\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatusRecords = [
            [
                'name'=>'New','status'=>1
            ],
            [
                'name'=>'Pending','status'=>1
            ],
            [
                'name'=>'Hold','status'=>1
            ],
            [
                'name'=>'Cancelled','status'=>1
            ],
            [
                'name'=>'In Progress','status'=>1
            ],
            [
                'name'=>'Paid','status'=>1
            ],
            [
                'name'=>'Shift','status'=>1
            ],
            [
                'name'=>'Delivered','status'=>1
            ],
        ];

        OrderStatus::insert($orderStatusRecords);
    }
}
