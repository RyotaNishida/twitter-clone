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

// デフォルトで記述されているルーティング
// Route::get('アドレス', 関数など);
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/tweet', [App\Http\Controllers\TweetController::class, 'tweet']);

//POSTリクエストが/homeエンドポイントに送信された場合に、App\Http\Controllers\TweetControllerクラスのsaveTweetメソッドが呼び出されるように指定。
Route::post('/tweets', [App\Http\Controllers\TweetController::class, 'create']);
Route::get('/tweets', [App\Http\Controllers\TweetController::class, 'getAll']);

Route::get('/show/{id}', [App\Http\Controllers\TweetController::class, 'findByTweetId'])->name('tweet.show');
Route::put('/show/{id}', [App\Http\Controllers\TweetController::class, 'update'])->name('tweet.show');