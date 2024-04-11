<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('api')->group(function () {
    //API account
    Route::get('/list', [OrderController::class, 'getData']);
    Route::get('/filter-step-1', [OrderController::class, 'filterStep1']);
    Route::get('/filter-step-2', [OrderController::class, 'filterStep2']);
});
