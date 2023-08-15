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
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
        Route::put('/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete');
    });
    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
        Route::get('/', [App\Http\Controllers\UserController::class, 'getAll'])->name('index');
        Route::post('/follow/{id}', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
        Route::delete('/follow/{id}', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');
        Route::get('/follower', [App\Http\Controllers\UserController::class, 'getAllFollowers'])->name('getFollowers');
        Route::get('/followed', [App\Http\Controllers\UserController::class, 'getFollowedUsers'])->name('getFollowedUsers');
    });
    Route::group(['prefix' => 'tweets', 'as' => 'tweet.'], function() {
        Route::post('/', [App\Http\Controllers\TweetController::class, 'postTweet'])->name('postTweet');
        Route::get('/', [App\Http\Controllers\TweetController::class, 'getAll'])->name('getAll');
        Route::get('/create', [App\Http\Controllers\TweetController::class, 'create'])->name('create');
        Route::get('/{id}', [App\Http\Controllers\TweetController::class, 'show'])->name('detail');
        Route::get('/{id}/edit', [App\Http\Controllers\TweetController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\TweetController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\TweetController::class, 'delete'])->name('delete');
    });
});
