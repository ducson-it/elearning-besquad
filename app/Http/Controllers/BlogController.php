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
//        $search = $request->input('searchblogs'); // Lấy giá trị tìm kiếm từ request

//        $query = Blog::query();

//        if ($search) {
//            $query->where('title', 'like', '%'.$search.'%'); // tìm kiếm theo tiêu đề
//        }
        $blogs = Blog::with('category')->paginate(5);
        $blogs->getCollection()->transform(function ($item) {
            if (isset($item->image['disk']) && isset($item->image['path'])) {
                $item->image = Storage::disk($item->image['disk'])->url($item->image['path']);
            } else {
                $item->image = '/storage/anh.png';
            }
            return $item;
        });

        return view('blog.list', compact('blogs'));
    }

    public function create(){
        $category_blogs = CategoryBlog::all();
        return view('blog.create',compact('category_blogs'));
    }
    public function store(Request $request){
        $media = session('blogs');
        Blog::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'user_id'=>Auth::user()->id,
            'description_short'=>$request->description_short,
            'image'=>$media,
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
        if (isset($blog->image['disk']) && isset($blog->image['path'])) {
            $blog->image = Storage::disk($blog->image['disk'])->url($blog->image['path']);
        } else {
            $blog->image = '/storage/anh.png';
        }
        return view('blog.edit', compact('blog','category_blogs'));
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $media = session('blogs');

        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description_short' => $request->description_short,
            'image' => $media,
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
