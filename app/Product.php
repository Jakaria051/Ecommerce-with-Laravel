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
}
