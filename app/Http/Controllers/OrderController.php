<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    function index(){
        return view('front.createOrder');
    }

    function store(OrderRequest $request){


        try {
            $value=$request['date'].$request['time'];
            $date=Carbon::create($value);
            $order=Order::create([
                'user_id'=>Auth::user()->id,
                'name'=>$request['orderName'],
                'description'=>$request['orderDescription'],
                'from_address'=>$request['fromAddress'],
                'to_address'=>$request['toAddress'],
                'delivery_time'=>$date,
                'notes'=>$request['notes'],
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);


            return redirect()->back()->with('done','your order '.$order->id.' waiting driver to accept ');
        }catch (Exception $e){
            return $e;
        }
    }
}
