<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * ユーザー詳細画面を表示
     *
     * @param string $userId
     * @param User $user
     * @return View|RedirectResponse
     */
    public function findByUserId(string $userId, User $user): View|RedirectResponse
    {
        //ログイン中のIDを取得
        if(Auth::id() !== (int) $userId) {
            return redirect()->route('home');
        }
        $userDetail = $user->findByUserId($userId);

        return view('user.show', ['userDetail' => $userDetail]);
    }

    /**
     * ユーザー情報の更新
     *
     * @param Request $request
     * @param string $userId
     * @return RedirectResponse
     */
    public function userUpdate(Request $request): RedirectResponse
    {
        $user = User::findOrFail(Auth::id());
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        $user->userUpdate($data);

        return redirect()->route('home')
            ->with('success', 'ユーザー情報が更新されました！');
    }

    /**
     * ユーザー情報を削除
     *
     * @param string $userId
     * @return RedirectResponse
     */
    public function userDelete(string $userId): RedirectResponse
    {
        $user = User::find($userId);
        
        if($user) {
            $user->delete();
            session()->flash('success', 'ユーザーが削除されました');
        } else {
            session()->flash('error', 'ユーザーが見つかりませんでした');
        }
        return redirect()->route('home');
    }

    /**
     * ユーザー一覧を取得
     *
     * @return View
     */
    public function getAll(): View
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }
}