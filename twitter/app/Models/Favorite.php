<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tweet;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tweet_id',
    ];

    /**
     * Tweetモデルとのリレーションを張る
     *
     * @return belongsTo
     */
    public function tweet(): belongsTo
    {
        return $this->belongsTo(Tweet::class, 'user_id', 'id');
    }

    /**
     * いいねする
     *
     * @param Int $userId
     * @param Int $tweetId
     * @return void
     */
    public function favorite(Int $userId, String $tweetId)
    {
        $favorite = new Favorite;
        $favorite->user_id = $userId;
        $favorite->tweet_id = $tweetId;
        return $favorite->save();
    }

    /**
     * いいね削除
     *
     * @param Int $userId
     * @param Int $tweetId
     * @return void
     */
    public function removeFavorite(Int $userId, Int $tweetId)
    {
        Favorite::where([
            ['user_id', $userId],
            ['tweet_id', $tweetId],
            ])->delete();
    }
}
