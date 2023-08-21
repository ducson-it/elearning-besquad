<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ForumPost;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ForumPostCollection;
use App\Http\Resources\CategoryPostsResource;
use App\Http\Resources\ForumPostResource;
class ForumPostController extends Controller
{
    public function index()
    {
        $forumposts = ForumPost::with([
            'comments' => function ($query) {
                $query->where('is_active', 1)
                    ->with(['user:id,name,avatar', 'childComments' => function ($query) {
                        $query->where('is_active', 1)
                            ->with('user:id,name,avatar');
                    }]);
            },
            'user:id,name,avatar',
            'category:id,name',
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return new ForumPostCollection($forumposts);
    }
    public function detail($id)
    {
        $forumpost = ForumPost::with([
            'comments' => function ($query) {
                $query->where('is_active', 1)
                    ->whereNull('parent_id')
                    ->with('childComments');
            },
            'comments.childComments' => function ($query) {
                $query->where('is_active', 1);
            },
            'user:id,name,avatar',
            'category:id,name',
            'user:id,name,avatar',
        ])
            ->findOrFail($id);
        return new ForumPostResource($forumpost);
    }
    public function clickStar(Request $request){
        $id = $request->input('id');
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
                'data' => ['post' => $post, 'user' => $user]
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
            'type' => $request->input('type'),
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
        $latestPosts =  ForumPost::with([
            'comments' => function ($query) {
                $query->where('is_active', 1)
                    ->whereNull('parent_id')
                    ->with('childComments');
            },
            'comments.childComments' => function ($query) {
                $query->where('is_active', 1);
            },
            'user:id,name,avatar',
            'category:id,name'
        ])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return ForumPostResource::collection($latestPosts);
    }
    //api post hay nhất
    public function getTopRatedPosts()
    {
        $topRatedPosts = ForumPost::with(['comments', 'category.courses'])
            ->orderBy('view', 'desc')
            ->orderBy('star', 'desc')
            ->limit(5)
            ->get();

        return ForumPostResource::collection($topRatedPosts);
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
    public function searchPosts(Request $request )
    {
        $key_word = $request->query('keyword');
        $searchResults = ForumPost::with(['comments', 'category'])
            ->where('title', 'like', '%' . $key_word . '%')
            ->get();

        return response()->json([
            'search_results' => $searchResults,
            'keyword' => $key_word,
        ]);
    }
    public function postsByCategory()
    {
        $allCategories = Category::all();
        $formattedData = [];
        foreach ($allCategories as $category) {
            $categoryPosts = ForumPost::with(['comments', 'user'])
                ->where('category_id', $category->id)
                ->orderByDesc('star')
                ->get();
            if ($categoryPosts->count() > 0) {
                $formattedData[] = [
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                    ],
                    'posts' => CategoryPostsResource::collection($categoryPosts),
                ];
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'Thành công',
            'data' => $formattedData,
        ]);
    }
    public function addview(Request $request){
        $id = $request->input('post_id');
        $post = ForumPost::find($id);
        $user = Auth::user();
        if(!$post){
            return response()->json([
                'code'=>404,
                'meesage'=> 'Not found',
            ]);
        }else{
            $count = $post->view+ 1;
            $post->update(['view'=>$count]);
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => ['post' => $post, 'user' => $user]
            ]);
        }

    }

}

