<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryBlogRequest;
use Illuminate\Support\Str;

class Category_BlogController extends Controller
{
    public function index(){
        $category_blogs = CategoryBlog::paginate(10);
        return view('category_blogs.list',compact('category_blogs'));
    }

    public function store(CategoryBlogRequest $request)
    {
        $validatedData = $request->validated();

        $slug = Str::slug($validatedData['name']);
        $validatedData['slug'] = $slug;
        CategoryBlog::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
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
