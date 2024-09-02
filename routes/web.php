<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//project routes start
Route::redirect('/','auth/login');

//user login & register
Route::get('auth/register',[AuthController::class,'registerPage'])->name('userRegister');
Route::get('auth/login',[AuthController::class,'loginPage'])->name('userlogin');


//GITHUB AND GOOGLE LOGIN
Route::get('/auth/{provider}/redirect', [ProviderController::class,'redirect']);

Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);

// HOME PAGE ROUTE
Route::get('login/register');



//admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/home', [AdminDashboardController::class,'index'])->name('adminDashboard');

    //category route group
    Route::prefix('category')->group(function(){

        Route::get('list', [CategoryController::class, 'list'])->name('categoryList');
        Route::get('create', [CategoryController::class, 'createPage'])->name('categoryCreatePage');
        Route::post('create', [CategoryController::class, 'create'])->name('categoryCreate');
    });
});


//user
Route::group(['prefix' => 'customer', 'middleware' => 'user'], function() {
    Route::get('/home', [UserDashboardController::class,'index'])->name('userDashboard');
});



