<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_canceled_by_driver extends Model
{
    use HasFactory;
    protected $table='orders_canceled_by_drivers';
    protected $guarded=[];

    function driver(){
        return $this->belongsTo(User::class,'driver_id','id');
    }

    function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
