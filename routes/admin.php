<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderBoardController;
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
        Route::get('list', [PaymentController::class, 'index'])->name('paymentList');
        Route::post('store', [PaymentController::class, 'store'])->name('paymentStore');
        Route::delete('delete/{id}', [PaymentController::class, 'destroy'])->name('paymentDelete');
    });

    // password
    Route::prefix('password')->group(function(){
        Route::get('change', [AuthController::class, 'passwordChangePage'])->name('passwordChangePage');
        Route::post('change', [AuthController::class, 'passwordChange'])->name('passwordChange');
    });

    //profile
    Route::prefix('profile')->group(function(){
        Route::get('details', [ProfileController::class, 'profileDetails'])->name('profileDetails');
        Route::post('update', [ProfileController::class, 'update'])->name('profileUpdate');
        Route::get('create/adminAccount', [ProfileController::class, 'createAdminAccount'])->name('createAdminAccount');
        Route::post('create/adminAccount', [ProfileController::class, 'create'])->name('createAdmin');
     });

         //role
    Route::prefix('role')->group(function(){
        Route::get('list', [RoleController::class, 'adminList'])->name('adminList');
        Route::get('delete/{id}', [RoleController::class, 'destroy'])->name('adminDelete');
        Route::get('changeUserRole/{id}', [RoleController::class, 'changeUserRole'])->name('changeUserRole');

        // user list
        Route::get('userlist', [RoleController::class, 'userList'])->name('userList');
        Route::get('deleteUser/{id}', [RoleController::class, 'destroyUser'])->name('userDelete');
        Route::get('changeAdminRole/{id}', [RoleController::class, 'changeAdminRole'])->name('changeAdminRole');
     });
     Route::prefix('order')->group(function(){
        Route::get('list', [OrderBoardController::class, 'adminOrderList'])->name('adminOrderList');

     });
});
