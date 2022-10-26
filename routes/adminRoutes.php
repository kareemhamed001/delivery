<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('home',[AdminController::class,'index']);
Route::post('dashboard',[AdminController::class,'getDashboardStatisticsResultsReady']);
Route::get('statistics',[AdminController::class,'statisticsView']);
Route::post('statistics',[AdminController::class,'getStatisticsPageResults']);
Route::get('orders',[AdminController::class,'ordersView']);
Route::get('order/{order}/show',[AdminController::class,'showOrder']);
Route::get('orders/create',[AdminController::class,'createOrderView']);
Route::post('orders/create',[AdminController::class,'store']);
Route::get('orders/running',[AdminController::class,'runningOrdersView']);
Route::get('orders/pending',[AdminController::class,'pendingOrdersView']);
Route::get('orders/delivered',[AdminController::class,'deliveredOrdersView']);
Route::get('orders/canceled', [AdminController::class, 'canceledOrdersView']);
Route::get('orders/today', [AdminController::class, 'todayOrdersView']);

Route::get('users',[AdminController::class,'usersView']);
Route::get('addUser',[AdminController::class,'addUserView']);
Route::post('addUser',[AdminController::class,'storeUser']);
