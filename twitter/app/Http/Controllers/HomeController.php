<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveTweet(Request $request)
    {
        //inputで入力した要素をDBに格納する処理
        $tweet = new Tweet();
        $tweet->tweet = $request->input('tweet');
        $tweet->save();
        return $tweet->all();
    }

    /** */
    public function index()
    {
        $allTweets = ;
        //ビューにツイートデータを渡す
        return view('home', ['allTweets' => $allTweets]);
    }
}
