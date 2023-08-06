<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//モデルをインポート
use App\Models\Tweet;
use App\Providers\RouteServiceProvider;

class TweetController extends Controller
{
    private $saveTweet;

    public function __construct(
        Tweet $saveTweet
    )
    {
        $this->saveTweet = $saveTweet;
    }

    public function tweet()
    {
        return view('create');
    }

    public function create(Request $request)
    {
        // リクエストからデータを取得
        $tweetText = $request->input('tweet');
        // バリデーション　140文字以上入力不可。
        $CreateTweetRequest = $request->validate([
            'tweet' => 'required|max:140',
        ]);

        //　モデルに新しいレコードを作成
        $tweet = new Tweet();
        $tweet->tweet = $tweetText;

        // データベースに保存
        $tweet->save();
        return $tweet;
    }

    public function getTweet()
    {
        //ツイートデータを取得して変数$allTweetsに代入
        $allTweets = Tweet::all();
        //ビューにツイートデータを渡す
        return view('home', ['allTweets' => $allTweets]);
    }

    public function findByTweetId($id)
    {
        $tweet = Tweet::findOrFail($id);
        return view('tweet.show', compact('tweet'));
    }

    public function update(Request $request)
    {
        dd($request);
    }

}