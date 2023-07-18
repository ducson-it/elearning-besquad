<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function showListUser()
    {
        $list_users = User::with('role')->Where('role_id', '<>', 1)->paginate(10);
       // var_dump($list_users);
        return view('users.list', compact('list_users'));
    }
    public function deleteUser($id)
    {
        $user = User::find($id)->delete();

        if ($user) {
            return redirect('/user/list')->with('message', 'Xóa thành công');
        } else {
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

    public function UserUpload(Request $request)
    {

        $file = $request->file('file');
        $file_type = $file->getClientOriginalExtension();
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/user_img', $file_name);
        $image = [
            'disk' => 'public',
            'path' => $path,
            'file_name' => $file_name,
            'file_type' => $file_type
        ];
        // Set the value of the "image" field in the request
        $request->merge(['image' => $path]);
        session()->put('media_user', $image);
        return response()->json($image, 200);
    }

    public function addUser()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));

    }

    public function storeUser(UserRequest  $request)
    {

        $media = session('media_user');
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'point'=>0,
            'role_id' => intval($request->role_id),
            'active' => $request->active,
            'avatar' => json_encode($media['path']),
            'address' => $request->address,
        ];

        $user = new User($data);
        if ($user->save()) {
            return redirect()->route('show.user')->with('message', 'Thêm thành công');
        } else {
            return redirect()->route('addUser')->with('message', 'Thêm thất bại');
        }
    }
    public function activeUser($id){
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
            return redirect()->route('show.user')->with('success', 'Đã cập nhật active thành công');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Cập nhật active thất bại');
        }


    }
    public function editUser($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }
    public function updateUser(UserRequest  $request,$id){
        $user = User::find($id);
        $media = session('media_user');
        $data = [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role_id' => intval($request->role_id),
            'active' => $request->active,
            'avatar' => json_encode($media['path']),
            'address' => $request->address,
        ];
        $user->update($data);

        // Lưu category vào cơ sở dữ liệu
        return redirect()->route('show.user')->with('message', 'sửa user thành công');

    }
    public function searchUser(Request $request){
        $search = $request->input('search_user');
        $list_users  = User::where('name', 'LIKE', '%'.$search.'%')->Where('role_id', '<>', 1)->paginate(10);
      //  dd($list_users);
        return view('users.list', compact('list_users'));
    }
}
