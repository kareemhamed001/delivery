<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class myOrdersController extends Controller
{
    function index(){

        return view('front.myOrders');
    }

    function runningOrders(){
        return view('front.running-orders');
    }
    function deliveredOrders(){
        return view('front.delivered-orders');
    }
    function canceledOrders(){
        return view('front.canceled-orders');
    }
}
