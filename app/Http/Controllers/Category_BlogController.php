<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class Category_BlogController extends Controller
{
    public function index(){
        $category_blogs = CategoryBlog::paginate(10);
        return view('category_blogs.list',compact('category_blogs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:sales,name|max:255',
            'slug' => 'required|date|before_or_equal:end_date',
            'description' => 'required|date|after_or_equal:start_date',
        ], [
            'name.required' => 'Tên không được để trống',
            'slug.required' => 'Tên không được để trống',
            'description.required' => 'Vui lòng nhập mô tả',
        ]);


        CategoryBlog::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('category_blogs.list')->with('success', 'Thêm Category_blogs thành công.');
    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
