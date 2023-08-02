<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    public function getVoucher(){
        $currentTime = Carbon::now();
        $vouchers = Voucher::where('expired', '>', $currentTime)
            ->Where('is_infinite',true)->get();

        return response()->json($vouchers);
    }
    public function checkVoucher(Request $request){
        $voucher = $request->input('voucher');
        $checkVoucher = Voucher::where('code',$voucher)->exists();
        $system_voucher = Voucher::where('code',$voucher)->first();
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
        return response()->json([
            'status'=>true,
            'data'=>$system_voucher
        ],200);
    }
}
