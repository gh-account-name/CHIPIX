<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\ProductController;
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

        Route::get('/characteristics', 'characteristicsPage')->name('characteristicsPage');

        Route::get('/products', 'productsPage')->name('productsPage');
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


    Route::controller(CharacteristicController::class)->group(function () {

        Route::get('/get/characteristic', 'get')->name('getCharacteristics');

        Route::post('/add/characteristic', 'store')->name('addCharacteristic');

        Route::post('/update/characteristic/{characteristic?}', 'update')->name('updateCharacteristic');

        Route::post('/delete/characteristic/{characteristic?}', 'destroy')->name('deleteCharacteristic');
    });


    Route::controller(ProductController::class)->group(function () {

        Route::get('/get/product', 'get')->name('getProducts');

        Route::post('/add/product', 'store')->name('addProduct');

        Route::post('/update/product/{product?}', 'update')->name('updateProduct');

        Route::post('/delete/product/{product?}', 'destroy')->name('deleteProduct');

        Route::post('/delete/product/image/{image?}', 'deleteimage')->name('deleteProductImage');
    });
});
