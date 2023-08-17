<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Beesquad;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:super-admin', ['only' => ['showListUser']]);
        //  $this->middleware('permission:admin create', ['only' => ['create','store']]);
        //  $this->middleware('permission:admin delete', ['only' => ['edit','update']]);
        //  $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function showListUser(Request $request)
    {
        // $list_users  = User::where([['name', 'LIKE', '%'.$request->search_user.'%'],[ 'role_id', '=',2 ]])
        //     ->orderBy('id', 'desc')
        //     ->paginate(Beesquad::PAGINATE);
        // var_dump($list_users);
        $list_users = Role::findById(2)->users()->where('name', 'LIKE', '%'.$request->search_user.'%')->orderBy('id', 'desc')->paginate(Beesquad::PAGINATE);
        return view('users.list', compact('list_users'));
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->syncRoles([]);
            $user->delete();
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


    public function addUser()
    {
        return view('users.create');
    }
    public function storeUser(UserRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'point' => 0,
                // 'role_id' => intval($request->role_id),
                'active' => $request->active,
                'avatar' => $request->filepath,
                'address' => $request->address,
            ];

            $user = new User($data);
            $user->assignRole(2);
            if ($user->save()) {
                return redirect()->route('show.user')->with('message', 'Thêm thành công');
            } else {
                return redirect()->route('addUser')->with('message', 'Thêm thất bại');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi cụ thể cho các ngoại lệ của truy vấn cơ sở dữ liệu
            return redirect()->route('addUser')->with('message', 'Lỗi khi thêm người dùng vào cơ sở dữ liệu: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Xử lý lỗi chung cho các ngoại lệ khác
            return redirect()->route('addUser')->with('message', 'Có lỗi xảy ra: ' . $e->getMessage());
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
        return view('users.edit',compact('user'));
    }
    public function updateUser(UserRequest $request,$id){
        $user = User::find($id);
        $data = [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            // 'role_id' => intval($request->role_id),
            'active' => $request->active,
            'avatar' =>$request->filepath,
            'address' => $request->address,
        ];
        $user->update($data);
        $user->syncRoles($request->role_id);

        // Lưu category vào cơ sở dữ liệu
        return redirect()->route('show.user')->with('message', 'sửa user thành công');

    }
}
