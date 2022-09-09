<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function index(){
        return view('front.createOrder');
    }

    function store(OrderRequest $request){
        try {
            Order::create([
                'user_id'=>Auth::user()->id,
                'name'=>$request['orderName'],
                'description'=>$request['orderDescription'],
                'from_address'=>$request['fromAddress'],
                'to_address'=>$request['toAddress'],
                'date'=>$request['date'],
                'time'=>$request['time'],
                'notes'=>$request['notes'],
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);

            session()->flash('done','your order is under review');
            return redirect()->back()->with('done','your order is under review');
        }catch (Exception $e){
            return $e;
        }
    }
}
