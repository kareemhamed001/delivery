<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $guarded=[];
    protected $dates=['delivery_time','created_at','updated_at'];

//    public $incrementing = false;
//    protected $keyType = 'string';
//
    protected static function boot()
    {
        parent::boot();

        Order::creating(function ($item) {
            $item->hashed_id=Hash::make($item->id);
        });
    }




    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function driver(){
        return $this->belongsTo(User::class,'accepted_by','id');
    }

    function canceledOrders(){
        return $this->hasMany(orders_canceled_by_driver::class,'order_id','id');
    }

}
