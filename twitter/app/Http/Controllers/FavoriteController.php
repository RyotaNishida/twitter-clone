<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Models\Tweet;
use App\Models\Favorite;
use App\Models\User;


class FavoriteController extends Controller
{

    /**
     * ツイートにいいねする
     *
     * @param Request $request
     * @param favorite $favorite
     * @return void
     */
    public function favoriteTweet(Request $request, favorite $favorite)
    {
        $userId = auth()->id(); // 現在のユーザーのIDを取得
        $tweetId = $request->input('tweetId'); // リクエストからツイートのIDを取得
        $isFavorite = $favorite->isFavorite($userId, $tweetId); // ユーザーが特定のツイートをお気に入りに登録済みかどうかを確認
        if(!$isFavorite) {
            $favorite->favorite($userId, $tweetId);
        } else {
            $favorite->removeFavorite($userId, $tweetId);
        }
    }

    /**
     * ログイン中のユーザーがいいねしたツイートを取得
     *
     * @param Favorite $favorite
     * @param Tweet $tweet
     * @return view
     */
    public function getAllByTweetIds(Favorite $favorite, Tweet $tweet): view
    {
        $userId = auth()->id();
        $favoriteTweets = $tweet->getAllFavoriteTweets($userId);
        return view('tweet.favorite', [
            'favoriteTweets' => $favoriteTweets
        ]);
    }
}
