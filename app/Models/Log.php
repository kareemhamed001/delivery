<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    use HasFactory;
    protected $table='logs';
    protected $guarded=[];

    function user(){
        return $this->hasOne(User::class,'user_id');
    }
}
