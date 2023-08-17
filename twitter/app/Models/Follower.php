<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Follower extends Model
{
    use HasFactory;

    /**
     *リレーション(フォローするユーザーを取得)
     *
     * @return BelongsToMany
     */
    public function follow(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
    }

    /**
     * リレーション(フォローしているユーザーを取得)
     *
     * @return belongsTo
     */
    public function following(): belongsTo
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    /**
     * リレーション(フォローされているユーザーを取得)
     *
     * @return belongsTo
     */
    public function followed(): belongsTo
    {
        return $this->belongsTo(User::class, 'followed_id');
    }

    /**
     * フォロワー一覧を取得
     *
     * @param Int $loginUserId
     * @return Collection
     */
    public function getAllFollowers(Int $loginUserId): Collection
    {
        return auth()->user()->followers()->get();
    }

    /**
     * フォロー一覧を取得
     *
     * @param Int $loginUserId
     * @return Collection
     */
    public function getAllFollowedUserByUserId(Int $loginUserId): Collection
    {
        return auth()->user()->follows()->get();
    }
}
