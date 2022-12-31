<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellOrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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


//login routes
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

//system routes
Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/home',[HomeController::class,'home'])->name('home');
Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

//resource routes
Route::resource('/accounts',AccountController::class);
Route::resource('/categories',CategoryController::class);
Route::resource('/products',ProductController::class);
Route::resource('/purchases',PurchaseOrderController::class);
Route::resource('/purchase-orders',PurchaseOrderController::class);
Route::resource('/sells',SellController::class);
Route::resource('/sell-orders',SellOrderController::class);
Route::resource('/settings',SettingsController::class)->only('index');
Route::resource('/shops',ShopController::class);
Route::resource('/transactions',TransactionController::class);
Route::resource('/users',UserController::class);

// specialized resource routes
Route::post('/change-password',[UserController::class,'changePassword'])->name('change-password');
Route::post('/products-change-image/{product}',[ProductController::class,'changeProductImage'])->name('products.change-image');
Route::get('/settings/{settings}/edit',[SettingsController::class,'edit'])->name('settings.edit');
Route::post('/settings/{settings}/update',[SettingsController::class,'update'])->name('settings.update');
?>
