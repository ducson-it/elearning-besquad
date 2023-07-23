<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function showListTeacher(Request $request)
    {
        $list_teachers = User::with('role')->Where('role_id',2 )->paginate(10);
        if($request->input('search_teacher')){
            $search = $request->input('search_teacher');
            $list_teachers  = User::where('name', 'LIKE', '%'.$search.'%')->Where('role_id',2)->paginate(10);
        }else{
            $search = "";
        }
        // var_dump($list_users);
        return view('teachers.list', compact('list_teachers','search'));
    }
    public function deleteUser($id)
    {
        $user = User::find($id)->delete();

        if ($user) {
            return redirect('/teacher/list')->with('message', 'Xóa thành công');
        } else {
            return redirect('/teacher/list')->with('message', 'Xóa thất bại');
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


    public function addTeacher()
    {
        $roles = Role::all();
        return view('teachers.create',compact('roles'));

    }
    public function storeTeacher(UserRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'point' => 0,
                'role_id' => intval($request->role_id),
                'active' => $request->active,
                'avatar' => $request->filepath,
                'address' => $request->address,
            ];

            $user = new User($data);
            if ($user->save()) {
                return redirect()->route('show.teacher')->with('message', 'Thêm thành công');
            } else {
                return redirect()->route('add.teacher')->with('message', 'Thêm thất bại');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi cụ thể cho các ngoại lệ của truy vấn cơ sở dữ liệu
            return redirect()->route('add.teacher')->with('message', 'Lỗi khi thêm người dùng vào cơ sở dữ liệu: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Xử lý lỗi chung cho các ngoại lệ khác
            return redirect()->route('add.teacher')->with('message', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function activeTeacher($id){
        $user  = User::find($id);
        try{
            if($user->active == 1){
                $user->update([
                    'active' => 0
                ]);
            }else{
                $user->update([
                    'active' => 1
                ]);
            }
            return redirect()->route('show.teacher')->with('success', 'Đã cập nhật active thành công');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Cập nhật active thất bại');
        }

    }
    public function editTeacher($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('teachers.edit',compact('user','roles'));
    }
    public function updateTeacher(UserRequest  $request,$id){
        $user = User::find($id);
        $data = [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role_id' => intval($request->role_id),
            'active' => $request->active,
            'avatar' =>$request->filepath,
            'address' => $request->address,
        ];
        $user->update($data);

        // Lưu category vào cơ sở dữ liệu
        return redirect()->route('show.teacher')->with('message', 'sửa user thành công');

    }
}