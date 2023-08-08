<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForumPost;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    public function index()
    {
        $forumposts = ForumPost::with('comments')->get();
        $formattedData = $forumposts->map(function ($post) {
            $commentCount = $post->comments->count();
            $formattedComments = $post->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user_id'=>$comment->user->name
                ];
            });
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'comment_count' => $commentCount,
                'comments' => $formattedComments,
            ];
        });

        return response()->json([
            'code' => 200,
            'message' => 'Thành công',
            'data' => $formattedData,
        ]);
    }

    public function detail($id)
    {
        $forumpost = ForumPost::findOrFail($id);
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data'=> $forumpost
        ]);
    }
    public function clickStar(Request $request ,$id){
        $post = ForumPost::find($id);
        $user = Auth::user();
        if(!$post){
            return response()->json([
                'code'=>404,
                'meesage'=> 'Not found',
            ]);
        }else{
            $count = $post->star+ 1;
            $post->update(['star'=>$count]);
            $user->update(['point' => $user->point + 10]);
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data'=> $post, $user
            ]);
        }

    }

    public function addPost(Request $request){
        $user_id = Auth::user()->id;
        if(!$user_id){
            return response()->json([
                'status' => false,
                'message'=>'Không tìm thấy người dùng đăng nhập vào hệ thống'
            ],404);
        }
        $data = [
            'title' => $request->input('title'),
            'content'=> $request->input('content'),
            'view'=>  0,
            'user_id'=>$user_id,
            'is_active'=> 0,
            'star'=> 0,
            'category_id'=>$request->input('category_id'),
            'type' => $request->input('type')
        ];
        $resulf = ForumPost::create($data);
        if($resulf){
            return response()->json([
                'status'=> true,
                'message'=>'Đã tạo post-forum  thành cong',
                'data'=> $data
            ],201);
        }else{
            return response()->json([
                'status'=> false,
                'message'=>'Đã gửi post-forum thất bại',
            ],500);
        }
    }
    public function updatePost(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy người dùng đăng nhập vào hệ thống'
            ], 404);
        }
        $post = ForumPost::find($id);
        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }
        $data = [
            'title' => $request->input('title', $post->title),
            'content' => $request->input('content', $post->content),
            'category_id' => $request->input('category_id', $post->category_id),
            'type' => $request->input('type', $post->type)
        ];
        if ($post->user_id !== $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không được phép cập nhật bài viết của người khác'
            ], 403);
        }

        $result = $post->update($data);

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'Đã cập nhật bài viết thành công',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Cập nhật bài viết thất bại',
            ], 500);
        }
    }

    public function deletePost($id)
    {
        $user_id = Auth::user()->id;
        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy người dùng đăng nhập vào hệ thống'
            ], 404);
        }

        $post = ForumPost::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }
        // Đảm bảo chỉ người tạo bài viết mới được phép xóa
        if ($post->user_id !== $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không được phép xóa bài viết của người khác'
            ], 403);
        }
        // Thực hiện xóa bài viết
        $result = $post->delete();

        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'Đã xóa bài viết thành công',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Xóa bài viết thất bại',
            ], 500);
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

