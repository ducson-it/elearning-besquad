<?php

namespace App\Http\Controllers;

use App\Models\Beesquad;
use App\Models\ForumComment;
use Illuminate\Http\Request;

class ForumCommentController extends Controller
{
    //
    public function showForumCmt(Request $request){
        $comments = ForumComment::where('content', 'LIKE', '%'.$request->search_forumCmt.'%')->paginate(10);
        return view('forum_comment.list',compact('comments'));
    }
    public function deleteForumCmt($id){
        $cmt = ForumComment::find($id)->delete();

        if ($cmt) {
            return redirect('/forum-comment/list')->with('message', 'Xóa thành công');
        } else {
            return redirect('/forum-comment/list')->with('message', 'Xóa thất bại');
        }
    }
    public function addForumCmt(){

    }

    public function updateForumCmt(){

    }
    public function storeForumCmt(){

    }
    public function activeForumCmt($id){
        $cmt  = ForumComment::find($id);
        try{
            if($cmt->active == 1){
                $cmt->update([
                    'is_active' => 0
                ]);
            }else{
                $cmt->update([
                    'is_active' => 1
                ]);
            }
            return redirect()->route('show.forumCmt')->with('success', 'Đã cập nhật active thành công');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Cập nhật active thất bại');
        }
    }

}
