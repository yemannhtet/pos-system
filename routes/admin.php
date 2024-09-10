<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;




Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function() {
    Route::get('/home', [AdminDashboardController::class,'index'])->name('adminDashboard');

    //category route group
    Route::prefix('category')->group(function(){
        Route::get('list', [CategoryController::class, 'list'])->name('categoryList');
        Route::get('create', [CategoryController::class, 'createPage'])->name('categoryCreatePage');
        Route::post('create', [CategoryController::class, 'create'])->name('categoryCreate');
        Route::get('delete/{id}' , [CategoryController::class, 'delete'])->name('categoryDelete');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categoryEdit');
        Route::post('update', [CategoryController::class, 'update'])->name('categoryUpdate');
    });


    //product route group
    Route::prefix('product')->group(function(){
        Route::get('list', [ProductController::class, 'list'])->name('productList');
        Route::get('create', [ProductController::class, 'create'])->name('ProductCreate');
        Route::post('create', [ProductController::class, 'productCreate'])->name('product#create');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('ProductDelete');
        Route::get('details/{id}', [ProductController::class, 'details'])->name('ProductDetails');
        Route::get('edit/{id}',[ProductController::class, 'edit'])->name('ProductEdit');
        Route::post('update', [ProductController::class, 'update'])->name('product#update');
    });
//payment
    Route::prefix('payment')->group(function(){
        Route::get('list', [PaymentController::class, 'list'])->name('paymentList');
    });
});
