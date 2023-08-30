<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateQueryRequest;
use App\Http\Requests\CreateTweetRequest;
use App\Models\Reply;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    public function createTweet(CreateTweetRequest $request, Tweet $tweet): RedirectResponse
    {
        $userId = auth()->id();
        $createTweet = $request->tweet;
        $tweet->create($userId, $createTweet);

        return redirect('tweets');
    }

    /**
     * ツイート一覧・検索結果一覧取得メソッド
     *
     * @param Tweet $tweet
     * @param CreateQueryRequest $request
     * @return View
     */
    public function getAll(Tweet $tweet, CreateQueryRequest $request): View
    {
        $query = $request->input('searchQuery');

        if($query) {
            //検索クエリが提供された場合、検索結果を取得
            $tweets = $this->searchByQuery($query);
            return view('tweet.index', ['tweets' => $tweets, 'query' => $query]);
        } else {
            $tweets = $tweet->getAll();
            return view('tweet.index', ['tweets' => $tweets]);
        }
    }

    /**
     * 検索ワードに紐づく投稿を検索
     *
     * @param string $query
     * @return void
     */
    public function searchByQuery(string $query)
    {
        $tweet = new Tweet;
        return $tweet->searchByQuery($query);
    }

    /**
     * 指定されたツイートIDに一致するツイートとリプライを取得し、ビューに渡すメソッド
     *
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return View
     */
    public function show(int $tweetId, Tweet $tweet, Reply $reply): View
    {
        $tweetDetail = $tweet->findByTweetId($tweetId);
        $allReply = $reply->getAllReply($tweetId);
        return view('tweet.show', [
            'tweetDetail' => $tweetDetail,
            'allReply' => $allReply,
        ]);
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
        $tweets = $tweet->findByTweetId($tweetId);
        return view('tweet.edit', ['tweets' => $tweets]);
    }

    /**
     * ツイート編集処理
     *
     * @param CreateTweetRequest $request
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function update(CreateTweetRequest $request, int $tweetId, Tweet $tweet): RedirectResponse
    {
        // request->allは推奨しない。
        // 意図しないパラメータが入る可能性があり、インジェクション攻撃を受ける可能性があり）
        $tweet->updateTweet($request->validated());
        return redirect('tweets');
    }

    /**
     * ツイート削除処理
     *
     * @param integer $tweetId
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function delete(int $tweetId, Tweet $tweet): RedirectResponse
    {
        $tweet->delete($tweetId);
        return redirect('tweets');
    }
}
