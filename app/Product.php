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

    public function attributes() {
        return $this->hasMany(ProductsAttribute::class);
    }

    public function images() {
        return $this->hasMany(ProductsImage::class);
    }
}
