<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ReplyController extends Controller
{
    /**
     * 新規リプライ
     *
     * @param Request $request
     * @param Int $tweetId
     * @param Reply $reply
     * @return void
     */
    public function createReply(Request $request, Int $tweetId, Reply $reply): RedirectResponse
    {
        $postReply = $reply->postReply($request->input('reply'), $tweetId);
        return back();
    }

    /**
     * リプライを削除
     *
     * @param Int $replyId
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function deleteReply(Int $replyId, Reply $reply): RedirectResponse
    {
        $deleteReply = $reply->deleteReply($replyId);
        return back();
    }

    /**
     * リプライの編集
     *
     * @param Request $request
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function editReply(Request $request, Reply $reply): RedirectResponse
    {
        $userId = auth()->id();
        $editReply = $request->input('reply');
        $editReplyId = intval($request->input('replyId'));
        $postEdit = $reply->editReply($userId, $editReply, $editReplyId);

        return back();
    }
}
