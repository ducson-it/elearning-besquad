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

        $userData = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
        ];
        // Xử lý ảnh và lưu URL
        if (isset($request['avatar']) && is_string($request['avatar'])) {
            $userData['avatar'] = $request['avatar'];
        }
        else {
            $userData['avatar'] = $user->avatar;
        }
        $update = $user->update($userData);
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
