<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryBlogRequest;
use Illuminate\Support\Str;

class Category_BlogController extends Controller
{
    public function index(Request $request)
    {
        $category_blogs = CategoryBlog::paginate(10);

        if ($request->has('search')) {
            $search = $request->input('search');
            $category_blogs = CategoryBlog::where('name', 'like', '%' . $search . '%')->paginate(10);
        }

        return view('category_blogs.list', compact('category_blogs'));
    }


    public function store(CategoryBlogRequest $request)
    {
        $slug = Str::slug($request->input('name'));
        CategoryBlog::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description'),
        ]);
        return redirect()->route('category_blog.list')->with('success', 'Thêm Category_blogs thành công.');
    }
    public function update(CategoryBlogRequest $request, $id)
    {
        $slug = Str::slug($request['name']);
        $request['slug'] = $slug;
        $categoryBlog = CategoryBlog::findOrFail($id);
        $categoryBlog->update([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'description' => $request['description'],
        ]);
        return redirect()->route('category_blog.list')->with('success', 'Cập nhật Category_blogs thành công.');
    }

    public function delete($id){
        $category_blogs = CategoryBlog::findOrFail($id);
        if($category_blogs->delete()){
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        }
        return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);

    }
}
