<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public static function sections()
    {
        $getsections = Section::with('categories')->where('status',1)->get();
        $getsections = json_decode(json_encode($getsections),true);
        return $getsections;
        // echo "<pre>";
        // print_r($getsections); die;
    }
    public function categories() {
    return $this->hasMany(Category::class,'section_id')->where(['parent_id'=>'ROOT','status'=>1])->with('subcategories');
    }
}
