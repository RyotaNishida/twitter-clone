<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('delete');
    });
    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
        Route::get('/', [UserController::class, 'getAll'])->name('index');
        Route::get('/follower', [UserController::class, 'getAllFollowers'])->name('getFollowers');
        Route::get('/followed', [UserController::class, 'getFollowedUsers'])->name('getFollowedUsers');
        Route::post('/follow/{id}', [UserController::class, 'follow'])->name('follow');
        Route::delete('/follow/{id}', [UserController::class, 'unfollow'])->name('unfollow');
    });
    Route::group(['prefix' => 'tweets', 'as' => 'tweet.'], function() {
        Route::post('/', [TweetController::class, 'createTweet'])->name('createTweet');
        Route::get('/', [TweetController::class, 'getAll'])->name('getAll');
        Route::get('/create', [TweetController::class, 'create'])->name('create');
        Route::get('/favorite', [FavoriteController::class, 'getAllByTweetIds'])->name('getFavorite');
        Route::get('/{id}', [TweetController::class, 'show'])->name('detail');
        Route::get('/{id}/edit', [TweetController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TweetController::class, 'update'])->name('update');
        Route::delete('/{id}', [TweetController::class, 'delete'])->name('delete');
        Route::post('/favorite/{tweetId}', [FavoriteController::class, 'favoriteTweet'])->name('favorite');
    });
});
