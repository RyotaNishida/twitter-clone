<?php

namespace App\Models;

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
     * 新規ツイートをデータベースに保存
     *
     * @param array $postTweet
     * @return boolean
     */
    public function create(array $postTweet): bool
    {
        $this->user_id = $postTweet['user_id'];
        $this->content = $postTweet['tweet'];
        return dd($this->save());
    }

    /**
     * すべてのツイートを取得
     *
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getAll(User $user)
    {
        $userId = $user->id;
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
     * 編集するツイートを取得
     *
     * @param Int $tweetId
     * @return Tweet
     */
    public function getEditTweet(Int $tweetId): Tweet
    {
        return $this->findOrFail($tweetId);
    }

    /**
     * ツイートを更新する処理
     *
     * @param Array $updateTweet
     * @return boolean
     */
    public function updateTweet(Array $updateTweet): bool
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

}
