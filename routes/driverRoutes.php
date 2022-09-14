<?php

use App\Http\Controllers\driver\DriverController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('home', [\App\Http\Controllers\driver\DriverController::class, 'index'])->name('driver.home');
Route::get('/',function (){
    return redirect(route('driver.home'));
} );

Route::get('my_orders', [DriverController::class, 'my_orders']);
Route::get('my_orders/running_orders',[DriverController::class,'runningOrders'])->name('driver.running_orders');
Route::get('my_orders/delivered_orders',[DriverController::class,'deliveredOrders'])->name('driver.delivered_orders');
Route::get('my_orders/canceled_orders',[DriverController::class,'canceledOrders'])->name('driver.canceled_orders');






