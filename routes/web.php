<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product Controller
Route::get('/product', [ProductController::class, 'index'])->name('index.product');
Route::get('/product/create', [ProductController::class, 'create'])->name('create.product');
Route::post('/product/create', [ProductController::class, 'store'])->name('store.product');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('show.product');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('edit.product');
Route::patch('/product/edit/{product}', [ProductController::class, 'update'])->name('update.product');
Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('delete.product');

// Cart Controller
Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/cart', [CartController::class, 'show_cart'])->name('show.cart');
Route::patch('/cart/update/{cart}', [CartController::class, 'update_cart'])->name('update.cart');
Route::delete('/cart/delete/{cart}', [CartController::class, 'destroy_cart'])->name('delete.cart');


// Order Controller
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/order', [OrderController::class, 'index'])->name('index.order');
Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show.order');
Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');
Route::post('/order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('confirm.payment');

//Use Controller
Route::get('users/profile', [ProfileController::class, 'show'])->name('show.user');
Route::post('users/profile', [ProfileController::class, 'update'])->name('update.user');
