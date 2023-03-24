<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayPaymentController;

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
Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user-dashboard')->middleware('auth');
Route::get('/user/orders', [App\Http\Controllers\UserController::class, 'orders'])->name('user-orders')->middleware('auth');;
Route::get('/user/search', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user-history')->middleware('auth');;
Route::get('/mycart', [App\Http\Controllers\UserController::class, 'cart'])->name('cart');
Route::post('/update-profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->middleware('auth');
Route::post('/support-from', [App\Http\Controllers\UserController::class, 'supportForm'])->middleware('auth');

Route::get('/category/{category}', [App\Http\Controllers\StoreController::class, 'categories'])->name('category');
Route::get('/brand/{brand}', [App\Http\Controllers\StoreController::class, 'brands'])->name('brand');
Route::post('/categoryProducts', [App\Http\Controllers\StoreController::class, 'categoryProducts']);
Route::get('/allbrands', [App\Http\Controllers\StoreController::class, 'allbrands'])->name('allbrands');
Route::get('/all-categories', [App\Http\Controllers\StoreController::class, 'allcategories']);
Route::get('/singleproduct/{slug}', [App\Http\Controllers\StoreController::class, 'singleProduct'])->name("product");
Route::get('/search', [App\Http\Controllers\StoreController::class, 'search']);
Route::post('/addCart', [App\Http\Controllers\CartController::class, 'addtoCart'])->name("addtocart");
Route::post('/updatecart', [App\Http\Controllers\CartController::class, 'updatecart'])->name("updatecart");
Route::post('/deletecart', [App\Http\Controllers\CartController::class, 'deletecart'])->name("deletecart");
Route::get('/mycart', [App\Http\Controllers\CartController::class, 'mycart'])->name("cart");
Route::get('/page/{slug}', [App\Http\Controllers\Pages::class, 'page'])->name("page");
Route::post('/subscribeEmail', [App\Http\Controllers\Pages::class, 'subscribList']);


Route::get('checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
Route::get('product', [RazorpayPaymentController::class, 'index']);
Route::get('buynow/{id}', [RazorpayPaymentController::class, 'buynow'])->name('buynow');
Route::post('paysuccess', [RazorpayPaymentController::class, 'razorPaySuccess']);
Route::get('razor-thank-you', [RazorpayPaymentController::class, 'RazorThankYou']);
Route::get('failed-payment', [RazorpayPaymentController::class, 'failedpayment']);
Route::post('checkoutnow', [RazorpayPaymentController::class, 'checkout']);
Route::post('saveAddress',[RazorpayPaymentController::class, 'saveAddress']);
Route::get('test', [RazorpayPaymentController::class, 'test']);
Route::get('build-your-pc', [App\Http\Controllers\MyComputer::class, 'index']);
Route::post("addtowishlist",[App\Http\Controllers\CartController::class, 'addtowishlist'])->name('addtowishlist');
Route::get("wishlist",[App\Http\Controllers\CartController::class, 'wishlist'])->name('wishlist');
Route::get("preowned-pc",[App\Http\Controllers\WelcomeController::class, 'preowned'])->name('preowned-pc');
Route::get("preowned-pc-single/{slug}",[App\Http\Controllers\WelcomeController::class, 'singlepreowned']);

URL::forceScheme('https');
