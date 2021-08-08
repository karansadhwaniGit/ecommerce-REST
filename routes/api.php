<?php

use App\Http\Controllers\BuyersController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//closure these are callback functions
Route::resource('buyers',BuyersController::class)->only('index','show');
Route::resource('users',UsersController::class)->except('edit','create');
