<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\myOrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Livewire\Driver\Home;
use App\Mail\testMail;
use App\Mail\testMail1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



//Route::get('/test', function () {
//    Mail::to('khidmt55@gmail.com')->send(new testMail1());
//    return 'done';
//});
Route::get('/test', function () {
    $basic  = new \Vonage\Client\Credentials\Basic("3326e318", "cDA5FbnWZ6nkPnMk");
    $client = new \Vonage\Client($basic);

    $response = $client->sms()->send(
        new \Vonage\SMS\Message\SMS("201021638451", 'Sprint', 'Welcome to sprint')
    );

    $message = $response->current();

    if ($message->getStatus() == 0) {
        echo "The message was sent successfully\n";
    } else {
        echo "The message failed with status: " . $message->getStatus() . "\n";
    }

});
Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware'=>['localeSessionRedirect','localizationRedirect','localeViewPath']],function (){
    Route::get('/', function () {
        return redirect(url('home'));
    });

    Route::get('/home', function () {
        return view('front.home');
    });

    Route::get('join_us',[HomeController::class,'joinUs']);
    Route::post('join_us',[HomeController::class,'storeJoinOrder']);

    Route::get('order',[OrderController::class,'index'])->middleware('verified');
    Route::post('order',[OrderController::class,'store'])->middleware('auth')->middleware('verified');

    Route::get('my_orders',[myOrdersController::class,'index'])->middleware('auth')->middleware('verified');

    Route::get('my_orders/running_orders',[myOrdersController::class,'runningOrders'])->middleware('auth')->middleware('verified');
    Route::get('my_orders/pending_orders',[myOrdersController::class,'pendingOrders'])->middleware('auth')->middleware('verified');
    Route::get('my_orders/delivered_orders',[myOrdersController::class,'deliveredOrders'])->middleware('auth')->middleware('verified');
    Route::get('my_orders/canceled_orders',[myOrdersController::class,'canceledOrders'])->middleware('auth')->middleware('verified');
});

Route::prefix('facebook')->name('facebook.')->group(function (){
    Route::get('login',[\App\Http\Controllers\FacebookLogin::class,'facebookLogin'])->name('login');
    Route::get('callback',[\App\Http\Controllers\FacebookLogin::class,'facebookCallback'])->name('callback');
});



Auth::routes(['verify' => true]);

