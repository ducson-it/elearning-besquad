<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    public function showVoucher(Request $request){
        $list_vouchers = Voucher::where('name', 'LIKE', '%'.$request->search_voucher.'%')->paginate(10);
        return view('vouchers.list',compact('list_vouchers'));
    }
    public function addVoucher(){
        return view('vouchers.create');
    }
    public function storeVoucher(VoucherRequest $request)
    {
        $value = $request->unit === 'VND' ? $request->vnd_value : $request->percentage_value;
        $option = $request->input('option');
        $quantity = $request->input('quantity');
        $isInfinite = $option === 'infinity' ? true : false;

        try {
            $voucher = Voucher::create([
                'name' => $request->name,
                'code' => $request->code,
                'value' => $value,
                'quantity' => $isInfinite ? null : $quantity,
                'unit' => $request->unit,
                'expired' => $request->expired,
                'is_infinite' => $isInfinite,
            ]);
            if ($voucher) {
                return redirect()->route('show.voucher')->with('message', 'Thêm thành công');
            } else {
                return redirect()->route('add.voucher')->with('message', 'Thêm thất bại');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi cụ thể cho các ngoại lệ của truy vấn cơ sở dữ liệu
            return redirect()->route('add.voucher')->with('message', 'Lỗi khi thêm voucher vào cơ sở dữ liệu: ' . $e->getMessage());
        }
    }

    public function editVoucher($id){
        $voucher = Voucher::find($id);
        return view('vouchers.edit',compact('voucher'));
    }
    public function updateVoucher(VoucherRequest  $request, $id){
        $voucher = Voucher::find($id);
        $value = $request->unit === 'VND' ? $request->vnd_value : $request->percentage_value;
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'value' => $value,
            'unit' => $request->unit,
            'expired' => $request->expired,
            'is_infinite' => (int)$request->is_infinite,
        ];
        $voucher->update($data);

        // Lưu category vào cơ sở dữ liệu
        return redirect()->route('show.voucher')->with('message', 'sửa voucher thành công');
    }
    public function deleteVoucher($id)
    {
        $voucher = Voucher::find($id)->delete();

        if ($voucher) {
            return redirect('/voucher/list')->with('message', 'Xóa thành công');
        } else {
            return redirect('/voucher/list')->with('message', 'Xóa thất bại');
        }

    }
}
