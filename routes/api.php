<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/customer', CustomerController::class);

Route::post('/customer/search', [CustomerController::class, 'search']);
Route::post('/product/search', [ProductController::class, 'search']);

Route::post('/order/send_mail/{id}', [OrderController::class, 'sendEmail']);
Route::post('/order/check_day', [OrderController::class, 'checkIfDayIsFull']);
