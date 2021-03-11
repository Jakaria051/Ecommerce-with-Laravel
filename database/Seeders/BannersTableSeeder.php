<?php

use App\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->truncate();
        $bannerRecords = [
            ['image'=>'banner1.png','link'=>'','title'=>'luxurious sheepskin and shearling garments','alt'=>'White Jacket','status'=>1],
            ['image'=>'banner2.png','link'=>'','title'=>'Fine quality real sheepskin and shearling','alt'=>'Black Jacket','status'=>1],
        ];

        Banner::insert($bannerRecords);
    }
}
