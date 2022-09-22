<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('home',[AdminController::class,'index']);
Route::get('statistics',[AdminController::class,'statisticsView']);
Route::get('orders',[AdminController::class,'ordersView']);
