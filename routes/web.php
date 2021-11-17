<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Users
    Route::get('/listUser', [UserController::class, 'getUser'])->name('getUser');
    Route::resource('user', UserController::class)->middleware('checkisadmin');

    // Rooms
    Route::get('/listRoom', [RoomController::class, 'getRoom'])->name('getRoom');
    Route::resource('room', RoomController::class)->middleware('checkisadmin');
    // Department
    Route::get('/listDepartment', [DepartmentController::class, 'getDepartment'])->name('getDepartment');
    Route::resource('department', DepartmentController::class)->middleware('checkisadmin');
    // Upload
    Route::post('upload/image', [UploadController::class, 'store']);

    // booking
    Route::post('booking', [BookingController::class, 'postRoom'])->name('postRoom');

    // Ajax
    Route::group(['prefix' => 'ajax'], function(){
    Route::get('room/{idRoom}/{date}', [BookingController::class, 'getRoom']);
    Route::get('search/user/{value}', [SearchController::class, 'searchUser']);
    Route::get('search/room/{value}', [SearchController::class, 'searchRoom']);
    Route::get('search/department/{value}', [SearchController::class, 'searchDepartment']);
    });
});
// Login
Route::get('/login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('register', [RegisterController::class, 'getRegister'])->name('getRegister');
Route::post('register', [RegisterController::class, 'postRegister'])->name('postRegister');

// forgot password
Route::get('forgotPassword', [RegisterController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forgotPassword', [RegisterController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [RegisterController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [RegisterController::class, 'submitResetPasswordForm'])->name('reset.password.post');