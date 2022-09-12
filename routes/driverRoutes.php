<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('home', [\App\Http\Controllers\driver\DriverController::class, 'index'])->name('driver.home');
Route::get('/',function (){
    return redirect(route('driver.home'));
} );
Route::get('my_orders', [\App\Http\Controllers\driver\DriverController::class, 'my_orders'])->name('driver.home');






