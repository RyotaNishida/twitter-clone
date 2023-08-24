<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class FavoriteController extends Controller
{

    /**
     * ツイートにいいねする
     *
     * @param Request $request
     * @param Favorite $favorite
     * @param User $user
     * @return void
     */
    public function favoriteTweet(Request $request, Favorite $favorite, User $user)
    {
        $userId = auth()->id(); // 現在のユーザーのIDを取得
        $tweetId = $request->input('tweetId'); // リクエストからツイートのIDを取得
        $isFavorite = $user->isFavorite($tweetId); // ユーザーが特定のツイートをお気に入りに登録済みかどうかを確認
        if(!$isFavorite) {
            $favorite->favorite($userId, $tweetId);
        } else {
            $favorite->removeFavorite($userId, $tweetId);
        }
    }

    /**
     * ログイン中のユーザーがいいねしたツイートを取得
     *
     * @param Tweet $tweet
     * @return View
     */
    public function getAllByTweetIds(Tweet $tweet): View
    {
        $userId = auth()->id();
        $favoriteTweets = $tweet->getAllFavoriteTweets($userId);
        return view('tweet.favorite', compact('favoriteTweets'));
    }
}
