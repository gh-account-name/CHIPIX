<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DirectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'authPage'])->name('authPage');

Route::post('/login', [UserController::class, 'login'])->name('login');


Route::middleware('auth:admin')->group(function () {

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');


    Route::controller(PageController::class)->group(function () {

        Route::get('/categories', 'categoriesPage')->name('categoriesPage');
    });


    Route::controller(DirectionController::class)->group(function () {

        Route::get('/get/direction', 'get')->name('getDirections');
    });


    Route::controller(CategoryController::class)->group(function () {

        Route::get('/get/category', 'get')->name('getCategories');

        Route::post('/add/category', 'store')->name('addCategory');

        Route::post('/update/category/{category?}', 'update')->name('updateCategory');

        Route::post('/delete/category/{category?}', 'destroy')->name('deleteCategory');
    });
});
