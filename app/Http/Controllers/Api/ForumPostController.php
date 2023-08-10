<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ForumPost;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    public function index()
    {
        $forumposts = ForumPost::with(['comments' => function ($query) {
            $query->where('is_active', 1);
        }])
            ->where('is_active', 1)
            ->get();
        $formattedData = $forumposts->map(function ($post) {
            $formattedComments = $post->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user_id' => $comment->user->name,
                    'parent_id' => $comment->parent_id,
                    'is_active' => $comment->is_active,
                ];
            });
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'view' => $post->view,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'deleted_at' => $post->deleted_at,
                'user_id' => [
                    'id' => $post->user->id,
                    'user' => $post->user->name,
                    'avatar' => $post->user->avatar,
                ],
                'star' => $post->star,
                'is_active' => $post->is_active,
                'type' => [
                    'id' => $post->type,
                    'description' => $post->type == 1 ? 'Thắc mắc'
                        : ($post->type == 2 ? 'Câu hỏi'
                            : ($post->type == 3 ? 'Thảo luận'
                                : ($post->type == 4 ? 'Giải trí' : 'Không xác định')))
                ],
                'comments' => $formattedComments,
                'category' => $post->category
                    ? [
                        'id' => $post->category->id,
                        'name' => $post->category->name,
                    ]
                    : null,
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
        $forumpost = ForumPost::with('comments')->findOrFail($id);
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $forumpost
        ]);
    }

    public function clickStar(Request $request)
    {
        $id = $request->input('id');
        $post = ForumPost::find($id);
        $user = Auth::user();
        if (!$post) {
            return response()->json([
                'code' => 404,
                'meesage' => 'Not found',
            ]);
        } else {
            $count = $post->star + 1;
            $post->update(['star' => $count]);
            $user->update(['point' => $user->point + 10]);
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => ['post' => $post, 'user' => $user]
            ]);
        }

    }

    public function addPost(Request $request)
    {
        $user_id = Auth::user()->id;
        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy người dùng đăng nhập vào hệ thống'
            ], 404);
        }
        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'view' => 0,
            'user_id' => $user_id,
            'is_active' => 0,
            'star' => 0,
            'category_id' => $request->input('category_id'),
            'type' => $request->input('type'),
        ];
        $resulf = ForumPost::create($data);
        if ($resulf) {
            return response()->json([
                'status' => true,
                'message' => 'Đã tạo post-forum  thành cong',
                'data' => $data
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Đã gửi post-forum thất bại',
            ], 500);
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
        $latestPosts = ForumPost::with(['comments' => function ($query) {
            $query->where('is_active', 1);
        }, 'category.courses', 'user'])
            ->where('is_active', 1) // Include the 'user' relationship
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return response()->json($latestPosts);
    }

    //api post hay nhất
    public function getTopRatedPosts()
    {
        $topRatedPosts = ForumPost::with(['comments' => function ($query) {
            $query->where('is_active', 1);
        }, 'category.courses', 'user'])
            ->where('is_active', 1)
            ->orderBy('view', 'desc')
            ->orderBy('star', 'desc')
            ->limit(5)
            ->get();

        return response()->json($topRatedPosts);
    }

    //API trả ra các bài post mà user đăng nhập đã tạo
    public function getUserPosts()
    {
        $user = Auth::user();
        if ($user) {
            $userPosts = ForumPost::with(['comments', 'category.courses'])
                ->where('user_id', $user->id)->get();
            return response()->json($userPosts);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    //API tìm kiếm bài post theo title
    public function searchPosts(Request $request)
    {
        $key_word = $request->query('keyword');

        $searchResults = ForumPost::with(['comments' => function ($query) {
            $query->where('is_active', 1);
        }, 'category.courses', 'user'])
            ->where('is_active', 1)
            ->where('title', 'like', '%' . $key_word . '%')
            ->where('is_active', 1)
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
                ->orderByDesc('star') // Sắp xếp theo trường 'star' giảm dần
                ->get();
            if ($categoryPosts->count() > 0) {
                $formattedPosts = $categoryPosts->map(function ($post) {
                    $formattedComments = $post->comments->map(function ($comment) {
                        return [
                            'id' => $comment->id,
                            'content' => $comment->content,
                            'user_id' => $comment->user->name,
                        ];
                    });
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'content' => $post->content,
                        'view' => $post->view,
                        'created_at' => $post->created_at,
                        'updated_at' => $post->updated_at,
                        'deleted_at' => $post->deleted_at,
                        'user_id' => [
                            'id' => $post->user->id,
                            'user' => $post->user->name,
                            'avatar' => $post->user->avatar,
                        ],
                        'star' => $post->star,
                        'is_active' => $post->is_active,
                        'type' => [
                            'id' => $post->type,
                            'description' => $post->type == 1 ? 'Thắc mắc'
                                : ($post->type == 2 ? 'Câu hỏi'
                                    : ($post->type == 3 ? 'Thảo luận'
                                        : ($post->type == 4 ? 'Giải trí' : 'Không xác định')))
                        ],
                        'comments' => $formattedComments,
                    ];
                });
                $formattedData[] = [
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                    ],
                    'posts' => $formattedPosts,
                ];
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'Thành công',
            'data' => $formattedData,
        ]);
    }

}

