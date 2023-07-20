<?php

namespace App\Http\Controllers;
use App\Http\Requests\BlogsRequest;
use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $blogs = Blog::where('title', 'like', '%' . $search . '%')->paginate(10);
        return view('blog.list', compact('blogs'));
    }

    public function create(){
        $category_blogs = CategoryBlog::all();
        return view('blog.create',compact('category_blogs'));
    }
    public function store(BlogsRequest $request){
        Blog::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'user_id'=>Auth::user()->id,
            'description_short'=>$request->description_short,
            'image'=>$request->filepath,
             'content'=>$request->content,
            'view'=>$request->view,
            'category_blog_id'=>$request->category_blog_id
        ]);
        return redirect()->route('blogs.list')->with('success', 'Thêm blogs thành công');
    }
    public function edit($id)
    {
        $blog= Blog::find($id);
        $category_blogs = CategoryBlog::all();
        return view('blog.edit', compact('blog','category_blogs'));
    }
    public function update(BlogsRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description_short' => $request->description_short,
            'image' => $request->filepath,
            'content' => $request->content,
            'view' => $request->view,
            'category_blog_id' => $request->category_blog_id
        ]);

        return redirect()->route('blogs.list')->with('success', 'Cập nhật blogs thành công');
    }
    public function delete($id){
        $blogs = Blog::findOrFail($id);
        if($blogs->delete()){
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        }
        return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
    }
}
