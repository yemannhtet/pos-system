<?php

use Illuminate\Support\Facades\Route;
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
});
