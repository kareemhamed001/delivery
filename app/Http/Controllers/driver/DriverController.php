<?php

namespace App\Http\Controllers\driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function index()
    {
        $orders=Order::where('canceled','0')->where('accepted','0')->where('finished','0')->paginate(50);
        return view('inc.home');
    }
}
