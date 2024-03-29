<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

        $productRecords = [
            [
                'id'=>1,'category_id'=>2,'section_id'=>1,'brand_id'=>1,'product_name'=>'Blue Casula T-Shirt',
                'product_code'=>'BT001','product_color'=>'Blue','product_price'=>'1500',
                'product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image'=>'',
                'description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'',
                'sleeve'=>'','fit'=>'','occasion'=>'','meta_title'=>'','meta_description'=>'',
                'meta_keywords'=>'','is_featured'=>'No','status'=>1
            ],
            [
                'id'=>2,'category_id'=>2,'section_id'=>1,'brand_id'=>2,'product_name'=>'Red Casula T-Shirt',
                'product_code'=>'RT001','product_color'=>'Red','product_price'=>'1600',
                'product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image'=>'',
                'description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'',
                'sleeve'=>'','fit'=>'','occasion'=>'','meta_title'=>'','meta_description'=>'',
                'meta_keywords'=>'','is_featured'=>'Yes','status'=>1
            ]
        ];

        Product::insert($productRecords);
    }
}
