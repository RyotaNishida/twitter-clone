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
     * @param Int $userId
     * @param User $user
     * @return User
     */
    public function findByUserId(Int $userId, User $user): User
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
     * @param Int $userId
     * @param User $user
     * @return View
     */
    public function show(Int $userId, User $user): View
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

    /**
     * フォローする処理
     *
     * @param Int $userId
     * @return RedirectResponse
     */
    public function follow(Int $userId): RedirectResponse
    {
        $follower = auth()->user();
        $isFollowing = $follower->isFollowing($userId); //フォローしているかチェック
        if(!$isFollowing) $follower->follow($userId);

        return back();
    }

    /**
     * フォロー解除処理
     *
     * @param Int $userId
     * @return RedirectResponse
     */
    public function unfollow(Int $userId): RedirectResponse
    {
        $follower = auth()->user();
        $isFollowing = $follower->isFollowing($userId); //フォローしているかチェック
        if($isFollowing) $follower->unfollow($userId);

        return back();
    }

    /**
     * フォローされているユーザーを表示
     *
     * @param Follower $follower
     * @return View
     */
    public function getAllFollowers(Follower $follower): View
    {
        $loginUserId = auth()->id();
        $followers = $follower->getAllFollowers($loginUserId);

        return view('user.follower', compact('followers'));
    }

    /**
     * フォローしているユーザーを表示
     *
     * @param Follower $follower
     * @return View
     */
    public function getFollowedUsers(Follower $follower): View
    {
        $loginUserId = auth()->user()->id;
        $followed = $follower->getAllFollowedUserByUserId($loginUserId);

        return view('user.followed', compact('followed'));
    }
}
