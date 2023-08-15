<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * ユーザーIDを取得
     *
     * @param integer $userId
     * @param User $user
     * @return View|RedirectResponse
     */
    public function findByUserId(int $userId, User $user): User
    {
        //ログイン中のIDを取得
        if(Auth::id() !== $userId) {
            return redirect()->route('home');
        }
        return $user->findByUserId($userId);
    }


    /**
     * ユーザー詳細画面を表示
     *
     * @param integer $userId
     * @param User $user
     * @return View
     */
    public function show(int $userId, User $user): View
    {
        $userDetail = $this->findByUserId($userId, $user);
        return view('user.show', ['userDetail' => $userDetail]);
    }

    /**
     * ユーザー情報の更新
     *
     * @param UserUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request): RedirectResponse
    {
        $user = User::findOrFail(Auth::id());
        if($request->hasAnyErrors()) {
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        $user->update($data);
        return redirect()->route('home')
            ->with('success', 'ユーザー情報が更新されました！');
    }

    /**
     * ユーザー情報を削除
     *
     * @param string $userId
     * @return RedirectResponse
     */
    public function delete(string $userId): RedirectResponse
    {
        $user = User::find($userId);
        $user->userDelete($userId);

        if($user) {
            return redirect()->route('home');
        }
    }

    /**
     * ユーザー一覧を取得
     *
     * @return View
     */
    public function getAll(): View
    {
        return view('user.index', ['users' => User::all()]);
    }

    // フォロー
    public function follow(Int $user_id)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user_id); //フォローしているかチェック
        if(!$is_following) {
            $follower->follow($user_id);
        }
        return back();
    }

    // フォロー解除
    public function unfollow(Int $user_id)
    {
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user_id); //フォローしているかチェック
        if($is_following) {
            $follower->unfollow($user_id);
        }
        return back();
    }

    public function getAllFollowers(Follower $follower)
    {
        $loginUserId = auth()->user()->id;
        $followers = $follower->getAllFollowers($loginUserId);
        return view('user.follower', compact('followers'));
    }

    public function getFollowedUsers(Follower $follower)
    {
        $loginUserId = auth()->user()->id;
        $followed = $follower->getAllFollowedUserByUserId($loginUserId);
        return view('user.followed', compact('followed'));
    }
}
