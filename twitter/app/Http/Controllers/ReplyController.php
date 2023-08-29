<?php

namespace App\Http\Controllers;

use App\Http\Requests\createReplyRequest;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ReplyController extends Controller
{
    /**
     * 新規リプライ
     *
     * @param CreateReplyRequest $request
     * @param integer $tweetId
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function createReply(CreateReplyRequest $request, int $tweetId, Reply $reply): RedirectResponse
    {
        $reply->storeReply($request->input('reply'), $tweetId);
        return back();
    }

    /**
     * リプライを削除
     *
     * @param integer $replyId
     * @param Reply $reply
     * @return RedirectResponse
     */
    public function deleteReply(int $replyId, Reply $reply): RedirectResponse
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
        $editReplyId = $request->id;
        $reply->editReply($userId, $editReply, $editReplyId);
        return back();
    }
}
