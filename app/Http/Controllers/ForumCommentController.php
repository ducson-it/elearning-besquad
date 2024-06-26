<?php

namespace App\Http\Controllers;

use App\Models\Beesquad;
use App\Models\ForumComment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Ui\Presets\React;
use App\Mail\ReplyForumComment;
class ForumCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:forumComments.list|forumComments.destroy|forumComments.reply|forumComments.active', ['only' => ['showForumCmt']]);
        $this->middleware('permission:forumComments.destroy', ['only' => ['deleteForumCmt']]);
        $this->middleware('permission:forumComments.reply', ['only' => ['replyForumCmt']]);
        $this->middleware('permission:forumComments.active', ['only' => ['activeForumCmt']]);
    }

    public function showForumCmt(Request $request)
    {
        $comments = ForumComment::with(['user', 'post'])
            ->where('content', 'LIKE', '%' . $request->search_forumCmt . '%')
            ->orderBy('id', 'desc')
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
        $data = [
            'user_id' => Auth::user()->id,
            'content' => $request->input('content'),
            'is_active' => 1,
            'post_id' => $request->input('post_id'),
        ];
        if($request->parent_id !== null){
            $data['parent_id'] = $request->input('parent_id');
        }else{
            $data['parent_id'] = $request->input('comment_id');
        }
        $newComment=  ForumComment::create($data);
        Notification::create([
            'title'=>'Quản trị viên đã phản hồi tin nhắn của bạn',
            'content'=>$request->input('content'),
            'priority'=> 'hight',
            'send_to' => 'group_users',
            ''
        ]);
        // send email
        $userComment = ForumComment::find($request->input('comment_id')) ;
        $user_name = Auth::user()->name; // Tên người gửi email (có thể thay đổi)
        $comment_content = $data['content'];
        $comment_post = $userComment->post->title;
        $time = now();
        Mail::to($userComment->user->email)->send(new ReplyForumComment($user_name, $comment_content, $comment_post, $time));
        if( $newComment){
            return redirect()->back()->with('success', 'Trả lời comment thành công.');
        }else{
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi admin phản hồi comment của người dùng ');
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
