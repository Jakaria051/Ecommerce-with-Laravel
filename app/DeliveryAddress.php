<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function deliveryAddressses() {
        $user_id = Auth::id();
        $deliveryAdress = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
        return $deliveryAdress;
    }
}
