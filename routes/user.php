<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\User\UserDashboardController;

//user
Route::group(['prefix' => 'customer', 'middleware' => 'user'], function() {
    Route::get('/home', [UserDashboardController::class,'index'])->name('userDashboard');

    Route::get('/shop/{category_id?}', [ShopController::class, 'shop'])->name('shopList');
    Route::get('details/{id}', [ShopController::class, 'details'])->name('details');
    Route::post('comment', [ShopController::class, 'comment'])->name('comment');
    Route::post('addRating', [ShopController::class, 'addRating'])->name('addRating');
});
 //profile
    Route::prefix('profile')->group(function(){
        Route::get('details', [ProfileController::class, 'Details'])->name('userProfileDetails');
        Route::post('update', [ProfileController::class, 'update'])->name('profileUpdate');

});
  // password
  Route::prefix('password')->group(function(){
    Route::get('change', [AuthController::class, 'passwordChangePage'])->name('passwordChangePage');
    Route::post('change', [AuthController::class, 'passwordChange'])->name('passwordChange');
});
//cart
Route::prefix('cart')->group(function(){
    Route::get('cart', [CartController::class, 'cartDetails'])->name('cartDetails');
    Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('remove/cart', [CartController::class, 'removeCart'])->name('removeCart');
    Route::get('order', [CartController::class, 'order'])->name('order');
    Route::get('orderList', [CartController::class, 'orderList'])->name('orderList');
    Route::get('details/{orderCode}', [CartController::class, 'userOrderDetails'])->name('userOrderDetails');
    Route::get('payment', [CartController::class, 'payment'])->name('payment');
    Route::post('order/product', [CartController::class, 'orderProduct'])->name('orderProduct');
});
