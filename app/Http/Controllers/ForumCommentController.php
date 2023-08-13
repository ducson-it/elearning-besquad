<?php

namespace App\Http\Controllers;

use App\Models\Beesquad;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class ForumCommentController extends Controller
{
    //
    public function showForumCmt(Request $request)
    {
        $comments = ForumComment::with(['user', 'post'])
            ->where('content', 'LIKE', '%' . $request->search_forumCmt . '%')
            ->paginate(8);
        return view('forum_comment.list', compact('comments'));
    }

    public function deleteForumCmt($id)
    {
        $cmt = ForumComment::find($id)->delete();

        if ($cmt) {
            return redirect('/forum-comment/list')->with('message', 'Xóa thành công');
        } else {
            return redirect('/forum-comment/list')->with('message', 'Xóa thất bại');
        }
    }

    public function replyForumCmt(Request $request)
    {
        // Validate input data
//        $this->validate($request, [
//            'parent_id' => 'required|integer',
//            'description' => 'required|string',
//        ]);
        $data = [
            'user_id' => Auth::user()->id,
            'email' => $request->email,
            'content' => $request->input('content'),
            'is_active' => 1,
            'post_id' => $request->input('post_id'),
            'parent_id' => $request->input('parent_id'),
        ];

        try {
            // Create a new comment
            $newComment = new ForumComment($data);
            // You may also need to set other attributes based on your logic
            return redirect()->back()->with('success', 'Trả lời comment thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi trả lời comment: ' . $e->getMessage());
        }

    }

    public function updateForumCmt()
    {

    }

    public function storeForumCmt()
    {

    }

    public function activeForumCmt($id)
    {
        $cmt = ForumComment::find($id);
        try {
            if ($cmt->active == 1) {
                $cmt->update([
                    'is_active' => 0
                ]);
            } else {
                $cmt->update([
                    'is_active' => 1
                ]);
            }
            return redirect()->route('show.forumCmt')->with('success', 'Đã cập nhật active thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật active thất bại');
        }
    }

}
