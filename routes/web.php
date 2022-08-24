<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user-dashboard');
Route::get('/user/orders', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user-orders');
Route::get('/user/search', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user-history');
Route::get('/mycart', [App\Http\Controllers\UserController::class, 'cart'])->name('cart');

Route::get('/category/{category}', [App\Http\Controllers\StoreController::class, 'categories'])->name('category');
Route::get('/allbrands', [App\Http\Controllers\StoreController::class, 'brands'])->name('allbrands');
