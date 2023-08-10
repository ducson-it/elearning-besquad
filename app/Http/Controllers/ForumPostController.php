<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostForumRequest;
use App\Models\ForumPost;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $forumposts = ForumPost::where('title', 'like', '%' . $search . '%')->paginate(8);
        return view('post_forum.list', compact('forumposts'));
    }

    public function create(){
        $categories = Category::all();
        return view ('post_forum.create',compact('categories'));
    }
    public function store(PostForumRequest $request){
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['view'] = 0;
        $data['star'] = 0;
        $data ['is_active'] = 0;
        $type = [
            '1' => 1, // Thắc mắc
            '2' => 2, // Câu hỏi
            '3' => 3, // Thảo luận
            '4' => 4, // Giải trí
        ];
        $data['type'] = $type[$data['type']];
        ForumPost::create($data);
        return redirect()->route('forum.list')->with('success', 'Thêm forumpost thành công');
    }
    public function edit($id)
    {
        $forumPost = ForumPost::findOrFail($id);
        $categories = Category:: all();
        return view('post_forum.edit', compact('forumPost','categories'));
    }

    public function update(PostForumRequest $request, $id)
    {
        $user = Auth::user();
        $post = ForumPost::find($id);
        if (!$post) {
            return redirect()->route('forum.list')->with('error', 'Bài viết không tồn tại');
        }
        $data = $request->all();
        if (isset($data['is_active']) && in_array($data['is_active'], [0, 1])) {
            $post->is_active = $data['is_active'];
        }
        $type = [
            '1' => 1, // Thắc mắc
            '2' => 2, // Câu hỏi
            '3' => 3, // Thảo luận
            '4' => 4, // Giải trí
        ];
        // Kiểm tra và cập nhật kiểu bài viết
        if (isset($data['type']) && array_key_exists($data['type'], $type)) {
            $post->type = $type[$data['type']];
        }
        $post->update($data);
        return redirect()->route('forum.list')->with('success', 'Sửa forumpost thành công');
    }

    public function delete($id)
    {
        $forumPost = ForumPost::find($id);
        $forumPost->delete();
        return redirect()->route('forum.list')->with('success', 'Xóa bài viết thành công');
    }

}
