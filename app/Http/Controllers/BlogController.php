<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Slider;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs= Blog::paginate(5);
        return view('blog.list',compact('blogs'));
    }
    public function create(){

    }
    public function store(){

    }
    public function edit(){

    }
    public function update(){

    }
    public function delete($id){
        $blogs = Blog::findOrFail($id);
        if($blogs->delete()){
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        }
        return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
    }
}
