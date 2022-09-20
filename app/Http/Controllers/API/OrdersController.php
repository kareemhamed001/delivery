<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    function fetchAll(){
        $orders=Order::all();
        if ($orders){
            return response($orders,200);
        }
        return response(null,400);
    }
}
