<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForumComment;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumCommentController extends Controller
{
    //


    public function addForumCmt(Request $request){
        $user = Auth::user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message'=>'Không tìm thấy người dùng đăng nhập vào hệ thống'
            ],404);
        }
        $data = [
            'content' => $request->input('content'),
            'user_id'=> Auth::user()->id,
            'is_active'=>  0,
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
        $data = [
            'content' => $request->input('content'),
            'user_id'=> Auth::user()->id,
            'is_active'=>  0,
            'post_id'=> $request->input('post_id'),
            'parent_id'=> $request->input('parent_id'),
        ];
        $resulf = ForumComment::create($data);
        if($resulf){
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

    // post mới nhất
    public function getLatestPosts()
    {
        $latestPosts = ForumPost::with('comments', 'category.courses')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($latestPosts);
    }
    //api post hay nhất
    public function getTopRatedPosts()
    {
        $topRatedPosts = ForumPost::with(['comments', 'category.courses'])
            ->orderBy('view', 'desc')
            ->orderBy('star', 'desc')
            ->limit(10)
            ->get();

        return response()->json($topRatedPosts);
    }
    //API trả ra các bài post mà user đăng nhập đã tạo
    public function getUserPosts()
    {
        $user = Auth::user();
        if($user){
            $userPosts = ForumPost::with(['comments', 'category.courses'])
            ->where('user_id', $user->id)->get();
            return response()->json($userPosts);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
    //API tìm kiếm bài post theo title
    public function searchPosts(Request $request)
    {
        $query = $request->input('search_post');

        $searchResults = ForumPost::where('title', 'like', '%' . $query . '%')->get();

        return response()->json($searchResults);
    }
}
