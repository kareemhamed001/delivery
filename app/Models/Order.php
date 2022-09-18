<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $guarded=[];
    protected $dates=['delivery_time','created_at','updated_at'];


    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    function canceledOrders(){
        return $this->hasMany(orders_canceled_by_driver::class,'order_id','id');
    }

}
