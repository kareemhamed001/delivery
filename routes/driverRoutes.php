<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('home', [\App\Http\Controllers\driver\DriverController::class, 'index']);






