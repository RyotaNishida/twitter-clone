<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTweetRequest;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


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
     * @return RedirectResponse
     */
    public function postTweet(CreateTweetRequest $request, Tweet $tweet): RedirectResponse
    {
        $userId = auth()->id();
        $postTweet = $request->all();
        $postTweet['user_id'] = $userId;
        $tweet->create($postTweet);

        return redirect('tweets');
    }

    /**
     * ツイート一覧取得メソッド
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
     * @param Int $tweetId
     * @param Tweet $tweet
     * @return View
     */
    public function show(Int $tweetId, Tweet $tweet): View
    {
        $tweetDetail = $tweet->findByTweetId($tweetId);
        return view('tweet.show', ['tweetDetail' => $tweetDetail]);
    }

    /**
     * ツイート編集画面
     *
     * @param Int $tweetId
     * @param Tweet $tweet
     * @return View
     */
    public function edit(Int $tweetId, Tweet $tweet): View
    {
        $tweets = $tweet->getEditTweet($tweetId);
        return view('tweet.edit', ['tweets' => $tweets]);
    }

    /**
     * ツイート編集処理
     *
     * @param CreateTweetRequest $request
     * @param Int $tweetId
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function update(CreateTweetRequest $request, Int $tweetId, Tweet $tweet): RedirectResponse
    {
        $tweet->updateTweet($request->all());
        return redirect('tweets');
    }

    /**
     * ツイート削除処理
     *
     * @param Int $tweetId
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function delete(Int $tweetId, Tweet $tweet): RedirectResponse
    {
        $tweet->deleteTweet($tweetId);
        return redirect('tweets');

    }
}
