<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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


Route::group(['middleware' => ['checklogin']], function () {
    Route::get('home', function () {
        return view('manager');
    })->name('home');
});
// Login
Route::get('login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('register', [RegisterController::class, 'getRegister'])->name('getRegister');
Route::post('register', [RegisterController::class, 'postRegister'])->name('postRegister');

// forgot password
Route::get('forgotPassword', [RegisterController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forgotPassword', [RegisterController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [RegisterController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [RegisterController::class, 'submitResetPasswordForm'])->name('reset.password.post');
