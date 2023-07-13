<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::paginate(5);
        return view('comments.list',compact('comments'));
    }
    public function create(){

    }
    public function store(){

    }
    public function edit($id){

    }
    public function update(){

    }
    public function delete($id){
        $comments = Comment::findOrFail($id);
        if($comments->delete()){
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        }
        return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
    }
}
