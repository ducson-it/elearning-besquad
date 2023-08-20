<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ReplyForumComment;
use App\Models\ForumComment;
use App\Models\ForumPost;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ForumCommentController extends Controller
{
    //add cmt
    public function addForumCmt(Request $request){
    $user_id = $request->input('user_id');
        $data = [
            'content' => $request->input('content'),
            'user_id'=> $user_id,
            'is_active'=>  1,
            'post_id'=> $request->input('post_id'),
            'parent_id'=> null,
        ];
        $resulf = ForumComment::create($data);
        if($resulf){
            return response()->json([
                'status'=> true,
                'message'=>'Đã tạo comment  thành cong',
                'data'=> $data
            ],201);
        }else{
            return response()->json([
                'status'=> false,
                'message'=>'Đã gửi comment thất bại',
            ],500);
        }
    }
    public function replyForumCmt(Request $request){
       $user_id =  $request->input('user_id');
       $user = User::find($user_id);
        $data = [
            'content' => $request->input('content'),
            'user_id'=> $user->id,
            'is_active'=>  1,
            'post_id'=> $request->input('post_id'),
            'parent_id'=> $request->input('parent_id'),
            'created_at' => Carbon::now(),
        ];
        $resulf = ForumComment::create($data);
        $post = ForumPost::find($request->input('post_id'));
        if($resulf){
            Mail::to($user->email)->send(new ReplyForumComment($user->name,$data['content'],$post->title,$data['created_at']));
            return response()->json([
                'status'=> true,
                'message'=>'Đã phản hoi comment  thành cong',
                'data'=>$data
            ],201);
        }else{
            return response()->json([
                'status'=> false,
                'message'=>'Đã phản hồi comment thất bại',
            ],500);
        }
    }
    public function updateForumCmt(Request $request,$id){
        $cmt = ForumComment::find($id);
        $data = [
            'content' => $request->input('content'),
        ];
       $resulf =  $cmt->update($data);
        if($resulf){
            return response()->json([
                'status'=> true,
                'message'=>'Đã sửa comment  thành cong',
            ],200);
        }else{
            return response()->json([
                'status'=> false,
                'message'=>'Đã sửa comment thất bại',
            ],500);
        }

    }
    public function deleteForumCmt($id){
        $cmt = ForumComment::find($id);
        $resulf = $cmt->delete();
        if($resulf){
            return response()->json([
                'status'=> true,
                'message'=>'Đã xóa thành cong',
            ],200);
        }else{
            return response()->json([
                'status'=> false,
                'message'=>'Đã  xóa tin nhắn  thất bại',
            ],500);
        }
    }


}
