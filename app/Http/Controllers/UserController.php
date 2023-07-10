<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showListUser(){
        $list_users = User::with('role')->Where('role_id','<>',1)->paginate(10);
        return view('users.list',compact('list_users'));
    }
    public function deleteUser($id){
        $user = User::find($id)->delete();

        if($user){
            return redirect('/user/list')->with('message', 'Xóa thành công');
        }else{
            return redirect('/user/list')->with('message', 'Xóa thất bại');
        }

    }
    public function deleteCheckbox(Request $request)
    {

        $selectedIds = $request->input('selectedIds');

        if ($selectedIds && is_array($selectedIds)) {
            // Xóa các bản ghi có ID nằm trong danh sách đã chọn
            User::whereIn('id', $selectedIds)->delete();

            // Trả về phản hồi cho giao diện
            return response()->json(['success' => true]);
        } else {
            // Trả về phản hồi lỗi khi selectedIds không hợp lệ
            return response()->json(['error' => 'Invalid selectedIds'], 400);
        }
    }
}
