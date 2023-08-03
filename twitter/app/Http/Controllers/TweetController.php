<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function postTweet(Request $request)
    {
        //inputに入力した内容（ツイート）を取得
        // $param = $request->tweet;
        // dd($param);     //dd・・処理を止める
        // dump($request->tweet);     //dump・・後に続く処理も続行
        // return view('home');
    }
}