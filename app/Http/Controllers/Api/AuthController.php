<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::once($credentials)) {
            return response()->json([
                'message' => 'Tài khoản hoặc mật khẩu không đúng'
            ], 401);
        }
        $user = Auth::getUser();
        $access_token = $user->createAuthToken('web')->plainTextToken;
        $refresh = $user->createRefreshToken('web');
        $refresh_token = $refresh->plainTextToken;
        $refresh_expired = $refresh->accessToken->expired_at;
        return response()->json([
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'expired'   => $refresh_expired

        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
        return response()->json([
            'message' => "Logout thành công",
        ], 200);
        } else {
            return response()->json([
                'message' => "Không tồn tại user",
            ], 404);
        }
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();

        $user->tokens()->where('name', 'auth')->delete();
        $user->tokens()->where('name', 'refresh')->delete();

        $accessToken = $user->createAuthToken('auth');

        $response = [
                'access_token' => $accessToken->plainTextToken,
        ];

        return response()->json($response, 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $access_token = $user->createAuthToken('web')->plainTextToken;
        $refresh = $user->createRefreshToken('web');
        $refresh_token = $refresh->plainTextToken;
        $refresh_expired = $refresh->accessToken->expired_at;

        return response()->json([
            'status' => 200,
            'message' => 'User Created Successfully',
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'expired'   => $refresh_expired
        ], 200);
    }
    //get user infor
    public function getUser(Request $request)
    {
        $user = User::with('histories')->find(Auth::id());
        return response()->json($user);
    }
}
