<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'panel', 'middleware' => 'auth'], function () {
    Route::resource('/posts', PostController::class);

    Route::get('/notif', [HomeController::class, 'invoice']);
    Route::get('/getMessage', [HomeController::class, 'getMessage']);

    Route::get('/mail', [HomeController::class, 'mail'])->name('mail');
});