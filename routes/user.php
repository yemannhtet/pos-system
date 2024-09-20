<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserDashboardController;

//user
Route::group(['prefix' => 'customer', 'middleware' => 'user'], function() {
    Route::get('/home', [UserDashboardController::class,'index'])->name('userDashboard');

    Route::get('/shop/{category_id?}', [ShopController::class, 'shop'])->name('shopList');
});
