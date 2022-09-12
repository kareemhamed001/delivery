<?php

namespace App\Http\Controllers\driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

    function my_orders(){

        return view('driver.myOrders');
    }

    function index()
    {
        $orders=Order::where('canceled','0')->where('accepted','0')->where('finished','0')->paginate(50);
        return view('driver.home');
    }
}
