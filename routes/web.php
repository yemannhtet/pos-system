<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
//project routes start
Route::redirect('/','auth/login');

//user login & register
Route::middleware('admin')->group(function () {
    Route::get('auth/register', [AuthController::class, 'registerPage'])->name('userRegister');
    Route::get('auth/login', [AuthController::class, 'loginPage'])->name('userlogin');
});

//GITHUB AND GOOGLE LOGIN
Route::get('/auth/{provider}/redirect', [ProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);

// // HOME PAGE ROUTE
// Route::get('login/register');

