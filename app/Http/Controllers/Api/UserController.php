<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function changeUser(Request $request)
    {
        $userId = Auth::id();

        // Tìm người dùng
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Tạo luật kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'avatar' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'old_password' => 'nullable|string', // Thêm luật kiểm tra mật khẩu cũ
            'confirm_password' => 'nullable|string|min:6', // Luật kiểm tra mật khẩu mới
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // Kiểm tra mật khẩu cũ
        if ($request->filled('old_password')) {
            $oldPassword = $request->old_password;

            if (Hash::check($oldPassword, $user->password)) {
                // Thay đổi mật khẩu mới nếu được cung cấp
                if ($request->filled('confirm_password')) {
                    $data['password'] = bcrypt($request->confirm_password);
                }
            } else {
                return response()->json(['message' => 'Mật khẩu cũ không đúng'], 400);
            }
        }
        // Cập nhật thông tin người dùng
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => json_encode($request->avatar),
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $user->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công',
            'data' => new UserResource($user)
        ]);
    }
}
