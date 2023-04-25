<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
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
});
