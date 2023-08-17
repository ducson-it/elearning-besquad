<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RedeemVoucher;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    //
    public function getVoucher($user_id){
        $currentTime = Carbon::now();
        $vouchers = Voucher::where('expired', '>', $currentTime)
            ->where(function ($query) use ($user_id) {
                $query->where('owner', $user_id)
                    ->orWhereNull('owner');
            })
            ->get();

        return response()->json($vouchers);
    }
    public function checkVoucher(Request $request){
        $user_id = $request->user_id;
        $voucher = $request->input('code');
        $checkVoucher = Voucher::where('code',$voucher)->exists();
        $system_voucher = Voucher::where('code',$voucher)->first();
        $voucher_user = UserVoucher::where('voucher_code',$voucher)
            ->Where('user_id',$user_id)->first();
        if(!$checkVoucher){
            return response()->json([
                'status'=>false,
                'message'=>'Voucher không tồn tại trong hệ thống'
            ]);
        }
        if(Carbon::now() > $system_voucher->expired){
            return response()->json([
                'status'=>false,
                'message'=>'Voucher đã hết hạn, vui lòng thử lại voucher khác'
            ]);
        }
        if ($voucher_user) {
            if ($voucher_user->is_used == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Voucher đã áp dụng rồi, mời bạn nhập mã code voucher khác'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin về voucher'
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=>$system_voucher
        ],200);
    }
    public function redeemVoucher(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $exchange_rate = $request->input('exchange_rate');
        $discount = 0;
        $requiredPoints = 0;

        if ($exchange_rate == 1) {
            $discount = 10;
            $requiredPoints = 50;
        } elseif ($exchange_rate == 2) {
            $discount = 20;
            $requiredPoints = 100;
        } else {
            $discount = 30;
            $requiredPoints = 150;
        }

        if ($user->point < $requiredPoints) {
            return response()->json([
                'status' => false,
                'message' => 'Voucher không đổi được do số điểm point của bạn không đủ'
            ]);
        }

        $code = $this->generateUniqueCode();
        $voucherData = [
            'name' => 'Voucher giảm giá ' . $discount . '% được quy đổi từ point',
            'code' => $code,
            'value' => $discount,
            'quantity' => 0,
            'unit' => 'Percent',
            'expired' => null,
            'is_infinite' => 1,
            'owner' => $user->id
        ];

        Voucher::create($voucherData);

        $user->update([
            'point' => $user->point - $requiredPoints
        ]);

        Mail::to($user->email)->send(new RedeemVoucher($user->name, $code, $voucherData['name'], $discount, $user->point));

        return response()->json([
            'status' => true,
            'message' => 'Bạn đã đổi voucher thành công, bạn hãy check email để lấy mã code giảm giá'
        ]);
    }
    private function generateUniqueCode($length = 10)
    {
        $code = Str::random($length);

        while (Voucher::where('code', $code)->exists()) {
            $code = Str::random($length);
        }

        return $code;
    }
}
