<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


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

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/post-login', [AuthController::class, 'login'])->name('post-login');

Route::get('/register', [AuthController::class, 'create'])->name('register');

Route::post('/post-register', [AuthController::class, 'store'])->name('post-register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']],function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
