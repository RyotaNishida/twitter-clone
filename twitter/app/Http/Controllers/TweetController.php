<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTweetRequest;
// use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class TweetController extends Controller
{

    /**
     * createビューページを返す
     *
     * @return View
     */
    public function create(): View
    {
        $user = auth()->user();
        return view('tweet.create', [
            'user' => $user
        ]);
    }

    /**
     * 新規ツイート投稿処理
     *
     * @param CreateTweetRequest $request
     * @param Tweet $tweet
     * @return void
     */
    public function postTweet(CreateTweetRequest $request, Tweet $tweet)
    {
        $user_id = auth()->id();
        $postTweet = $request->all();
        $postTweet['user_id'] = $user_id;
        $tweet->create($postTweet);

        return redirect('tweets');
    }

    /**
     * [ツイート一覧取得]メソッド
     *
     * @param Tweet $tweet
     * @return View
     */
    public function getAll(Tweet $tweet): View
    {
        $allTweets = $tweet->getAll(auth()->user());
        return view('tweet.index', ['allTweets' => $allTweets]);
    }

    /**
     * 指定されたツイートIDに一致するツイートを取得し、ビューに渡すメソッド
     *
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return View
     */
    public function show(int $tweetId, Tweet $tweet): View
    {
        $getTweetDetail = $tweet->findByTweetId($tweetId);
        return view('tweet.show', ['tweetDetail' => $getTweetDetail]);
    }

    /**
     * ツイート編集画面
     *
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return View
     */
    public function edit(int $tweetId, Tweet $tweet): View
    {
        $tweets = $tweet->getEditTweet($tweetId);
        return view('tweet.edit', [
            'tweets' => $tweets,
        ]);
    }

    /**
     * ツイート編集処理
     *
     * @param CreateTweetRequest $request
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return void
     */
    public function update(CreateTweetRequest $request, int $tweetId, Tweet $tweet)
    {
        $postEditTweet = $request->all();
        $tweet->tweetUpdate($postEditTweet);

        return redirect('tweets');
    }

    /**
     * ツイート削除
     *
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return void
     */
    public function delete(int $tweetId, Tweet $tweet)
    {
        $deleteTweet = $tweet->tweetDelete($tweetId);
        return redirect('tweets');

    }
}
