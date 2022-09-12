<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class myOrdersController extends Controller
{
    function index(){
        $orders=Order::where('user_id',Auth::user()->id)->where('canceled','0')->get();

        return view('front.myOrders',compact('orders'));
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
