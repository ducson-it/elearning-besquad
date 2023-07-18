<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangeUserRequest;


class UserController extends Controller
{
    public function changeUser(ChangeUserRequest $request)
    {
        $userId = Auth::id();
        // Tìm người dùng
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $data = $request->validated();
        // Kiểm tra ảnh
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            // Lưu ảnh mới
            $path = $file->store('avatars', 'public');
            $avatar = json_encode(['disk' => 'public', 'path' => $path]);
        } else {
            // Giữ lại ảnh cũ
            $avatar = $user->avatar;
        }
        $update = $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $avatar,
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
        if (!$update) {
            return response()->json(['message' => 'Update failed'], 400);
        }
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công',
            'data' => new UserResource($user)
        ], 200);
    }

}
