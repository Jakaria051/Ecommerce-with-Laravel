<?php

use App\ProductsImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_images')->truncate();

        $productsImageRecords = [
            'id'=>1, 'product_id'=>1,'image'=>'emerudin.jpg-34073','status'=>1
        ];
        ProductsImage::insert($productsImageRecords);
    }
}
