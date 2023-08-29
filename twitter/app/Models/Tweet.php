<?php

namespace App\Models;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection\array;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Tweet extends Model
{
    use softDeletes, HasFactory;

    protected $fillable = ['content'];

    /**
     * 新規ツイートを保存
     *
     * @param Int $userId
     * @param string $postTweet
     * @return boolean
     */
    public function create(Int $userId, string $createTweet): bool
    {
        $this->user_id = $userId;
        $this->content = $createTweet;
        return $this->save();
    }

    /**
     * すべてのツイートを取得
     *
     * @param Int $userId
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getAll(Int $userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    /**
     * 指定されたツイートIDに一致するツイートを取得
     *
     * @param Int $tweetId
     * @return Tweet
     */
    public function findByTweetId(Int $tweetId): Tweet
    {
        return $this->findOrFail($tweetId);
    }

    /**
     * ツイートを更新する処理
     *
     * @param Array $updateTweet
     * @return boolean
     */
    public function updateTweet(array $updateTweet): bool
    {
        $this->content = $updateTweet['tweet'];
        $this->user_id = $updateTweet['user_id'];
        return $this->update();
    }

    /**
     * ツイートをデータベースから削除
     *
     * @param Int $tweetId
     * @return boolean
     */
    public function deleteTweet(Int $tweetId): bool
    {
        $deleteTweet = $this->findOrFail($tweetId);
        return $deleteTweet->delete();
    }


    /**
     * ログイン中のユーザーがいいねしたツイートを取得
     *
     * @param Int $userId
     * @return Collection
     */
    public function getAllFavoriteTweets(Int $userId): Collection
    {
        // ①favoriteテーブルにおいて、user_idで絞り込み。tweet_idのみ取得
        $favoriteTweets = Favorite::where('user_id', $userId)->pluck('tweet_id')->toArray();
        // ②絞り込んだfavoriteのtweet_idをもとに、紐付くtweetを取得
        return $tweets = Tweet::whereIn('id', $favoriteTweets)->get();
    }
}
