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
}
