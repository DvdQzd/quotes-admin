<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard'); // while there's no landing page we're deridecting to the dashboard
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

Route::resource('/customer', CustomerController::class)->middleware(['auth:sanctum', 'verified']);
Route::get('/customer/search/{searchText}', [CustomerController::class, 'index']);

Route::resource('/order', OrderController::class)->middleware(['auth:sanctum', 'verified']);
