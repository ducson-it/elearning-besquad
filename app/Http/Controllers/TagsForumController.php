<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\TagsForum;
use Illuminate\Http\Request;

class TagsForumController extends Controller
{
    public function index(){
        $tagsforum= TagsForum::paginate(8);
        return view('tagsforum.list',compact('tagsforum'));
    }
    public function create(){
        return redirect()->route('tagsforum.list')->with('success', 'Thêm tags thành công.');
    }
    public function store(Request $request)
    {
        $data = ['name' => $request->input('name')];
        TagsForum::create($data);
        return redirect()->route('tagsforum.list')->with('success', 'Thêm tags thành công.');
    }
    public function update(Request $request, $id)
    {

        $tag = TagsForum::find($id);
        if (!$tag) {
            return redirect()->route('tagsforum.list')->with('error', 'Không tìm thấy thẻ tag');
        }
        // Lấy dữ liệu từ request
        $data = ['name' => $request->input('name')];

        // Cập nhật dữ liệu cho thẻ tag
        $tag->update($data);
        return redirect()->route('tagsforum.list')->with('success', 'Cập nhật tags thành công.');
    }

    public function delete($id){
        $tagsforum = TagsForum::findOrFail($id);
        $tagsforum->delete();
        return redirect()->route('tagsforum.list')->with('success',"Xóa thành công");
    }
}
