<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * ユーザーIDを取得
     *
     * @param string $userId
     * @return User
     */
    public function findByUserId(string $userId): User
    {
        return User::find($userId);
    }

    /**
     * ユーザー情報の更新内容を保存
     *
     * @param array $data
     * @return User
     */
    public function userUpdate(array $data): User
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->save();
    }

    /**
     * ユーザーIDに一致するユーザーを削除
     *
     * @param string $userId
     */
    public function userDelete(string $userId)
    {
        $user = static::find($userId);

        if($user) {
            $user->delete();
        }
        return $user;
    }

    /**
     * すべてのユーザー情報を取得
     *
     * @return User
     */
    public function getAll(): User
    {
        return User::all();
    }

    /**
     * Undocumented function
     *
     * @return belongsToMany
     */
    public function follows(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'following_id');
    }

    /**
     * フォローする
     *
     * @param Int $user_id
     * @return Int
     */
    public function follow(Int $user_id): ?int
    {
        return $this->follows()->attach($user_id);
    }

    /**
     * フォロー解除
     *
     * @param Int $user_id
     * @return Int
     */
    public function unfollow(Int $user_id): ?int
    {
        return $this->follows()->detach($user_id);
    }

    /**
     * フォローしているかチェック
     *
     * @param Int $user_id
     * @return boolean
     */
    public function isFollowing(Int $user_id): bool
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    /**
     * フォローされているかチェック
     *
     * @param Int $user_id
     * @return boolean
     */
    public function isFollowed(Int $user_id): bool
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
}
