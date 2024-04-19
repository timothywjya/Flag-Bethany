<?php

use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', function () {
//     return view('home');
// })->name('home')->middleware('auth');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('user-management', [UserController::class, 'index']);
    Route::get('get-data-users', [UserController::class, 'getDataUser']);
    Route::get('get-data-roles', [UserController::class, 'getDataRole']);

    Route::get('change-my-password', [ChangePasswordController::class, 'index']);
    Route::post('/change-password', [ChangePasswordController::class, 'UpdateNewPassword'])->name('change-password');
});
