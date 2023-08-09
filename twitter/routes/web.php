<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/', [App\Http\Controllers\UserController::class, 'getAll'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
        Route::put('/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete');
    });
});