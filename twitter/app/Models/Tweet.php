<?php

namespace App\Models;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Collection\array;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Pagination\LengthAwarePaginator;

class Tweet extends Model
{
    use softDeletes, HasFactory;

    protected $fillable = ['content'];

    /**
     * 新規ツイートを保存
     *
     * @param integer $userId
     * @param string $createTweet
     * @return boolean
     */
    public function create(int $userId, string $createTweet): bool
    {
        $this->user_id = $userId;
        $this->content = $createTweet;
        return $this->save();
    }

    /**
     * すべてのツイートを取得
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this::orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * 指定されたツイートIDに一致するツイートを取得
     *
     * @param integer $tweetId
     * @return Tweet
     */
    public function findByTweetId(int $tweetId): Tweet
    {
        return $this->find($tweetId);
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
     * @param integer $tweetId
     * @return boolean
     */
    public function deleteTweet(int $tweetId): bool
    {
        $deleteTweet = $this->findOrFail($tweetId);
        return $deleteTweet->delete();
    }


    /**
     * ログイン中のユーザーがいいねしたツイートを取得
     *
     * @param integer $userId
     * @return Collection
     */
    public function getAllFavoriteTweets(int $userId): Collection
    {
        // ①favoriteテーブルにおいて、user_idで絞り込み。tweet_idのみ取得
        $favoriteTweets = Favorite::where('user_id', $userId)->pluck('tweet_id')->toArray();
        // ②絞り込んだfavoriteのtweet_idをもとに、紐付くtweetを取得
        return $tweets = Tweet::whereIn('id', $favoriteTweets)->get();
    }

    /**
     * 検索ワードに紐づくデータをDBより取得
     *
     * @param string $searchQuery
     * @return LengthAwarePaginator
     */
    public function searchByQuery(string $searchQuery): LengthAwarePaginator
    {
        $getTweetQuery = $this::query();

        if(!empty($searchQuery)) {
            // $searchQueryの中身が空で無い場合処理実行
            $searchTweet = $getTweetQuery
                ->where('content', 'LIKE', "%{$searchQuery}%")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return $searchTweet;
        }

        $queryTweet = $getTweetQuery->paginate(10);
        return $queryTweet;
    }
}
