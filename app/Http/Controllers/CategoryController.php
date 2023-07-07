<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('categories',compact('categories'));
    }

    public function store(Request $request)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
            'slug'=>Str::slug($request->name)
        ];
        Category::create($data);
        return redirect()->route('categories')->with('message','Thêm thành công');
    }

    public function update(Category $category, Request $request)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
        ];
        $category->update($data);
        return redirect()->route('categories')->with('message','Cập nhật thành công');

    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('categories')->with('message','Xoá thành công');

    }
}
