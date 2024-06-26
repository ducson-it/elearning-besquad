<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Jobs\SendVoucherEmail;
use App\Mail\VoucherSystemMail;
use App\Models\Notification;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:vouchers.list|vouchers.store|vouchers.update|vouchers.destroy', ['only' => ['showVoucher']]);
        $this->middleware('permission:vouchers.store', ['only' => ['addVoucher','storeVoucher']]);
        $this->middleware('permission:vouchers.update', ['only' => ['editVoucher','updateVoucher']]);
        $this->middleware('permission:vouchers.destroy', ['only' => ['deleteVoucher']]);
    }
    //
    public function showVoucher(Request $request){
        $list_vouchers = Voucher::where('name', 'LIKE', '%'.$request->search_voucher.'%')
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view('vouchers.list',compact('list_vouchers'));
    }
    public function addVoucher(){
        return view('vouchers.create');
    }
    public function storeVoucher(VoucherRequest $request)
    {
        $value = $request->unit === 'VND' ? $request->vnd_value : $request->percentage_value;

        try {
            $voucher = Voucher::create([
                'name' => $request->name,
                'code' => $request->code,
                'value' => $value,
                'quantity' => 0,
                'unit' => $request->unit,
                'expired' => $request->expired,
                'is_infinite' => 1,
            ]);
             $discount  = $value . ($request->unit == 'Percent' ? "%" : "VND" );

            Notification::create([
                'title' => 'Thông báo nhận voucher miễn phí từ hệ thống',
                'content' => "Bạn đã nhận được voucher miễn phí. " . $discount . " Mã code là: " . $request->code,
                'is_read' => 0,
                'is_deleted' => 0,
                'priority' => 'high',
                'notification_type' => 'hệ thống',
                'send_to' => 'system',
                'expired' => $request->expired,
                'send_user' => 'admin'
            ]);
            // $list_users = User::where('role_id', '>', 1)
            //     ->where('active', 1)
            //     ->get();
            $list_users = Role::findById(2)->users()->get();
            // Lấy  thông tin user đang thực hiện thao tác
            foreach ($list_users as $user) {
                SendVoucherEmail::dispatch($user, $request->code, $discount, $request->expired);
            }
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
        $formattedExpired = Carbon::parse($voucher->expired)->format('Y-m-d');
        return view('vouchers.edit',compact('voucher','formattedExpired'));
    }
    public function updateVoucher(VoucherRequest  $request, $id){
        $voucher = Voucher::find($id);
        $value = $request->unit === 'VND' ? $request->vnd_value : $request->percentage_value;
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'value' => $value,
            'quantity' => 0,
            'unit' => $request->unit,
            'expired' => $request->expired,
            'is_infinite' => 1,
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
