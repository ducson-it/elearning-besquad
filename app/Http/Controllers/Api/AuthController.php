<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

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
        $refresh_token = $user->createRefreshToken('web')->plainTextToken;
        return response()->json([
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
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
        $user = Auth::user();
        $user->tokens()->delete();
        $access_token = $user->createAuthToken('web')->plainTextToken;
        $refresh_token = $user->createRefreshToken('web')->plainTextToken;
        return response()->json([
            'access_token' => $access_token,
            'refresh_token' => $refresh_token
        ], 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(2);

        $access_token = $user->createAuthToken('web')->plainTextToken;
        $refresh_token = $user->createRefreshToken('web')->plainTextToken;

        return response()->json([
            'status' => 200,
            'message' => 'User Created Successfully',
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
        ], 200);
    }
    //get user infor
    public function getUser(Request $request)
    {
        $user = User::with('histories')->find(Auth::id());
        return response()->json($user);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }
}
