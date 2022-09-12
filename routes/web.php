<?php

use App\Http\Controllers\myOrdersController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::get('/test', function () {
    return view('welcome');
});
Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware'=>['localeSessionRedirect','localizationRedirect','localeViewPath']],function (){
    Route::get('/', function () {
        return redirect(url('home'));
    });

    Route::get('/home', function () {
        return view('front.home');
    });

    Route::get('order',[OrderController::class,'index']);
    Route::post('order',[OrderController::class,'store'])->middleware('auth');

    Route::get('my_orders',[myOrdersController::class,'index'])->middleware('auth');

    Route::get('my_orders/running_orders',[myOrdersController::class,'runningOrders'])->middleware('auth');
    Route::get('my_orders/delivered_orders',[myOrdersController::class,'deliveredOrders'])->middleware('auth');
    Route::get('my_orders/canceled_orders',[myOrdersController::class,'canceledOrders'])->middleware('auth');
});

Auth::routes();

