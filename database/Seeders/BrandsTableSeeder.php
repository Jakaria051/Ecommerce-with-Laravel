<?php

use App\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->truncate();

        $brandRecords = [
            [
                'name'=>'Arrow','status'=>1
            ],
            [
                'name'=>'Nike','status'=>1
            ],
            [
                'name'=>'Lee','status'=>1
            ],
            [
                'name'=>'Adidas','status'=>1
            ]
        ];

        Brand::insert($brandRecords);
    }
}
