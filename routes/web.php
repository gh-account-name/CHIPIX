<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::controller(PageController::class)->group(function () {

    Route::get('/', 'mainPage')->name('mainPage');

    Route::get('/catalog/{category}/{direction?}', 'catalogPage')->name('catalogPage');

    Route::get('/product/{product?}', 'productPage')->name('productPage');
});


Route::post('/send/mail', [MailController::class, 'sendMail'])->name('sendMail');
