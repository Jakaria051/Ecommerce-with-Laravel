<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function section() {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function attributes() {
        return $this->hasMany(ProductsAttribute::class);
    }

    public function images() {
        return $this->hasMany(ProductsImage::class);
    }

    public static function productFilters()
    {
        $productFilters['fabricArray'] = array('Cotton','Polyester','Wool');
        $productFilters['sleeveArray'] = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeeveless');
        $productFilters['PatternArray'] = array('Checked','Plain','Printed','Self','Solid');
        $productFilters['fitArray'] = array('Regular','Slim');
        $productFilters['occasionArray'] = array('Casual','Formal');

        return $productFilters;
    }

    public static function getDiscountPrice($product_id)
    {
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
        if($proDetails['product_discount'] > 0)
        {
            $discount_price = $proDetails['product_price'] - ($proDetails['product_price']*$proDetails['product_discount']/100);
            // 450 = original 500 - discount 10% 50
        }else if($catDetails['category_discount'] > 0)
        {
            $discount_price = $proDetails['product_price'] - ($proDetails['product_price']*$catDetails['category_discount']/100);
        }else {
            $discount_price = 0;
        }
        return $discount_price;
    }
}
