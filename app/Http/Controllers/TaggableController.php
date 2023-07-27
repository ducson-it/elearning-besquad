<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;

class TaggableController extends Controller
{
    //
    public function getTaggable(Request $request, $tag_id) {
        $search = $request->input('search_taggable', '');

        $taggables = Taggable::with('tag')
            ->where('tag_id', $tag_id)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('tag', function ($subquery) use ($search) {
                    $subquery->where('name', 'LIKE', '%' . $search . '%');
                });
            })
            ->paginate(10);

        return view('tags.taggable', compact('taggables', 'tag_id', 'search'));
    }

    public function deleteTaggable($id){
        $tag = Taggable::find($id);
        if($tag->delete()){
            return redirect('/tag/list')->with('message', 'Xóa thành công'); // Sửa lại 'Thêm thành công' thành 'Xóa thành công'
        }else{
            return redirect('/tag/list')->with('message', 'Xóa thất bại');
        }
    }
    public function deleteCheckbox(Request $request)
    {

        $selectedIds = $request->input('selectedIds');

        if ($selectedIds && is_array($selectedIds)) {
            // Xóa các bản ghi có ID nằm trong danh sách đã chọn
            Taggable::whereIn('id', $selectedIds)->delete();

            // Trả về phản hồi cho giao diện
            return response()->json(['success' => true]);
        } else {
            // Trả về phản hồi lỗi khi selectedIds không hợp lệ
            return response()->json(['error' => 'Invalid selectedIds'], 400);
        }
    }

}
