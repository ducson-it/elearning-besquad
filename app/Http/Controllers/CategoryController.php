<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::paginate(5);
        return view('categories',compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
            'slug'=>Str::slug($request->name)
        ];
        Category::create($data);
        return response()->json([
            'status'=>true,
            'message'=>'Thêm thành công'
        ]);
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status
        ];
        $category->update($data);
        return response()->json([
            'status'=>true,
            'message'=>'Cập nhật thành công'
        ]);

    }
    public function show($category_id){
        $category = Category::find($category_id);
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công'
        ]);
    }
}
