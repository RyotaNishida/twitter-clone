<?php

namespace App\Models;

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
     * @return void
     */
    public function create(array $postTweet)
    {
        $this->user_id = $postTweet['user_id'];
        $this->content = $postTweet['tweet'];
        return $this->save();
    }

    /**
     * すべてのツイートを取得
     *
     * @param [type] $user
     * @return void
     */
    public function getAll($user)
    {
        $userId = $user->id;
        return $this->where('user_id', $userId)->get();
    }

    /**
     * 指定されたツイートIDに一致するツイートを取得
     *
     * @param int $tweetId
     * @return Tweet
     */
    public function findByTweetId(int $tweetId): Tweet
    {
        return Tweet::findOrFail($tweetId);
    }

    /**
     * 編集するツイートを取得
     *
     * @param [type] $tweetId
     * @return Tweet
     */
    public function getEditTweet($tweetId): Tweet
    {
        return Tweet::findOrFail($tweetId);
    }

    /**
     * ツイートを更新する処理
     *
     * @param array $postEditTweet
     * @return void
     */
    public function tweetUpdate(array $postEditTweet)
    {
        $this->content = $postEditTweet['tweet'];
        $this->user_id = $postEditTweet['user_id'];
        return $this->update();
    }

    /**
     * ツイートをデータベースから削除
     *
     * @param [type] $tweetId
     * @return void
     */
    public function tweetDelete($tweetId)
    {
        $tweet = Tweet::findOrFail($tweetId);
        return $tweet->delete();
    }

}
