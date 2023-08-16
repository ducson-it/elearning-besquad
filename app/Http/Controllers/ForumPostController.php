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
        $data['type'] = $request->input('type');
        ForumPost::create($data);
        return redirect()->route('forum.list')->with('success', 'Thêm bài viết thành công');
    }
    public function edit($id)
    {
        $forumPost = ForumPost::findOrFail($id);
        $categories = Category:: all();
        return view('post_forum.edit', compact('forumPost','categories'));
    }
    public function update(PostForumRequest $request, $id)
    {
        $post = ForumPost::find($id);
        if (!$post) {
            return redirect()->route('forum.list')->with('error', 'Bài viết không tồn tại');
        }
        $data = $request->all();
        $post->update($data);
        return redirect()->route('forum.list')->with('success', 'Sửa bài viết thành công');
    }
    public function status($id){
        $status = ForumPost::find($id);
        try{
            if($status->is_active == 0){
                $status->update([
                    'is_active' => 1
                ]);
            }else{
                $status->update([
                    'is_active' => 0
                ]);
            }
            return redirect()->route('comment.list')->with('success', ' Thành công');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Thất bại');
        }
    }
    public function delete($id)
    {
        $forumPost = ForumPost::findOrFail($id);
        if($forumPost->delete()){
            return redirect()->route('forum.list')->with('success',"Xóa thành công");
        }
        return redirect()->route('forum.list')->with('error',"Xóa thành công");
    }
}
