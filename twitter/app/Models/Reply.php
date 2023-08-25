<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replys';

    protected $fillable = ['user_id', 'content'];

    /**
     * リプライを作成
     *
     * @param String $postReply
     * @param Int $tweetId
     * @return void
     */
    public function postReply(String $postReply, Int $tweetId)
    {
        $this->user_id = auth()->id();
        $this->tweet_id = $tweetId;
        $this->content = $postReply;
        return $this->save();
    }

    /**
     * ツイート毎にすべてのリプライを取得
     *
     * @param Int $tweetId
     * @return Collection
     */
    public function getAllReply(Int $tweetId): Collection
    {
        return $allReplys = $this::where('tweet_id', $tweetId)->get();
    }

    /**
     * リプライ削除
     *
     * @param Int $replyId
     * @return void
     */
    public function deleteReply(Int $replyId)
    {
        $deleteReply = $this->findOrFail($replyId);
        return $deleteReply->delete();
    }

    /**
     * リプライを編集
     *
     * @param Int $userId
     * @param String $editReply
     * @param Int $editReplyId
     * @return boolean
     */
    public function editReply(Int $userId, String $editReply, Int $editReplyId): bool
    {
        return $reply = $this->where('id', '=', $editReplyId)->update([
            'content' => $editReply
        ]);
    }
}
