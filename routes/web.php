<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecisionMakerController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolDetailController;
use App\Http\Controllers\UserCategoriesController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\AhpController;
use App\Http\Controllers\ArasController;
use App\Http\Controllers\CategoryController;


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

    Route::prefix('decision-maker')->group(function () {
        Route::get('/', [DecisionMakerController::class, 'index'])->name('decision-maker');
        Route::get('/create', [DecisionMakerController::class, 'create'])->name('create-decision-maker');
        Route::post('/store', [DecisionMakerController::class, 'store'])->name('store-decision-maker');
        Route::get('/edit/{id}', [DecisionMakerController::class, 'edit'])->name('edit-decision-maker');
        Route::post('/update/{id}', [DecisionMakerController::class, 'update'])->name('update-decision-maker');
        Route::delete('/destroy/{id}', [DecisionMakerController::class, 'destroy'])->name('destroy-decision-maker');
    });

    Route::prefix('user-categories')->group(function () {
        Route::get('/', [UserCategoriesController::class, 'index'])->name('user-categories');
        Route::get('/create', [UserCategoriesController::class, 'create'])->name('create-categories');
        Route::post('/store', [UserCategoriesController::class, 'store'])->name('store-categories');
        Route::get('/edit', [UserCategoriesController::class, 'edit'])->name('edit-categories');
        Route::post('/update', [UserCategoriesController::class, 'update'])->name('update-categories');
        // Route::delete('/destroy/{id}', [UserCategoriesController::class, 'destroy'])->name('destroy-categories');
    });

        Route::prefix('category')->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->middleware('permission:read_category')->name('category');
            Route::get('/create', [CategoryController::class, 'create'])->middleware('permission:create_category')->name('create-category');
            Route::post('/store', [CategoryController::class, 'store'])->middleware('permission:create_category')->name('store-category');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->middleware('permission:update_category')->name('edit-category');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->middleware('permission:update_category')->name('update-category');
            Route::delete('/destroy/{id}', [CategoryController::class, 'update'])->middleware('permission:update_category')->name('update-category');
        });

        Route::prefix('school')->group(function () {
            Route::get('/', [SchoolController::class, 'index'])->name('school');
            ROute::get('/show/{id}', [SchoolDetailController::class, 'show'])->name("show-school");
            Route::get('/create', [SchoolController::class, 'create'])->middleware('permission:create_school')->name('create-school');
            Route::get('/create-detail/{id}', [SchoolDetailController::class, 'create'])->middleware('permission:create_school')->name('create-detail');
            Route::post('/store', [SchoolController::class, 'store'])->middleware('permission:create_school')->name('store-school');
            Route::post('/store-detail/{id}', [SchoolDetailController::class, 'store'])->middleware('permission:read_school')->name('store-detail');
            Route::get('/edit/{id}', [SchoolController::class, 'edit'])->middleware('permission:update_school')->name('edit-school');
            Route::get('/edit-detail/{id}', [SchoolDetailController::class, 'edit'])->middleware('permission:update_school')->name('edit-detail');
            Route::post('/update/{id}', [SchoolController::class, 'update'])->middleware('permission:update_school')->name('update-school');
            Route::post('/update-detail/{id}', [SchoolDetailController::class, 'update'])->middleware('permission:update_school')->name('update-detail');
            Route::delete('/destroy/{id}', [SchoolController::class, 'destroy'])->middleware('permission:delete_school')->name('destroy-school');
        });

    Route::prefix('calculate')->group(function (){
        Route::get('/', [CalculateController::class, 'index'])->name('calculate');
        Route::get('/weighting/{id}', [AhpController::class, 'index'])->name('weighting');
        Route::post('/process/{id}', [AhpController::class, 'calculate'])->name('process');
        Route::get('/alternate/{id}', [ArasController::class, 'index'])->name('alternate');
        Route::post('/store/{id}', [ArasController::class, 'store'])->name('store-aras');
        Route::get('/direction/{id}', [ArasController::class, 'direction'])->name('direction');
        Route::post('/set-decision-maker/{id}', [ArasController::class, 'setDecisionMaker'])->name('set-decision-maker');
    });
});
