<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';

    protected $fillable = [
        'user_id',
        'content',
        'tweet_id',
    ];

    /**
     * リプライを作成
     *
     * @param string $storeReply
     * @param integer $tweetId
     * @return void
     */
    public function storeReply(string $storeReply, int $tweetId)
    {
        $this->user_id = auth()->id();
        $this->tweet_id = $tweetId;
        $this->content = $storeReply;
        return $this->save();
    }

    /**
     * ツイート毎にすべてのリプライを取得
     *
     * @param integer $tweetId
     * @return Collection
     */
    public function getAllReply(int $tweetId): Collection
    {
        return $allReplys = $this::where('tweet_id', $tweetId)->get();
    }

    /**
     * リプライ削除
     *
     * @param integer $replyId
     * @return void
     */
    public function deleteReply(int $replyId)
    {
        $deleteReply = $this->find($replyId);
        return $deleteReply->delete();
    }

    /**
     * リプライを編集
     *
     * @param integer $userId
     * @param string $editReply
     * @param string $editReplyId
     * @return boolean
     */
    public function editReply(int $userId, string $editReply, string $editReplyId): bool
    {
        return $reply = $this->where('id', '=', $editReplyId)->update([
            'content' => $editReply
        ]);
    }
}
