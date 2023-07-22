<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/product', [ProductController::class, 'index'])->name('index.product');
Route::get('/product/create', [ProductController::class, 'create'])->name('create.product');
Route::post('/product/create', [ProductController::class, 'store'])->name('store.product');
Route::get('/product/show/{product}', [ProductController::class, 'show'])->name('show.product');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('edit.product');
Route::patch('/product/edit/{product}', [ProductController::class, 'update'])->name('update.product');
Route::delete('/product/delete/{product}', [ProductController::class, 'destroy'])->name('delete.product');
