<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function show(Request $request) {
        $search = $request->input('search_tag', '');

        $tags = Tag::where('name', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return view('tags.list', compact('tags', 'search'));
    }

    public function storetag(TagRequest $request){
       $data = [
           'name' => $request->input('name'),
           'description' => $request->input('tag_description'),
       ];

       if ($request->ajax()) {
           try {
               Tag::create($data);
               return response()->json(['message' => 'Thêm thành công']);
           } catch (\Exception $e) {
               return response()->json(['error' => 'Có lỗi xảy ra khi tạo tag'], 500);
           }
       }

       Tag::create($data);
       return redirect()->route('show.tag')->with('message', 'Thêm thành công');
   }
   public function deleteTag($id){
       $tag = Tag::find($id);

       if($tag->delete()){
           $taggables_delete = Taggable::where('tag_id',$id)->delete();
       }
       // Sử dụng $tag->delete() để xóa bản ghi
       return redirect('/tag/list')->with('message', 'Xóa thành công'); // Sửa lại 'Thêm thành công' thành 'Xóa thành công'
   }
   public function editTag(TagRequest $request,$id){
       $tag = Tag::find($id);
      $update_tag =  $tag->update([
           'name'=> $request->input('name'),
            'description'=>$request->input('description')
       ]);
       return redirect()->route('show.tag')->with('message', 'Chỉnh sửa thành công');
   }

}
