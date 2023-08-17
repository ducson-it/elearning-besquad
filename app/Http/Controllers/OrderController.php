<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Beesquad;
use App\Models\Course;
use App\Models\Order;
use App\Models\Study;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with('user','course')->latest()->paginate(5);
        return view('orders.list',compact('orders'));
    }
    public function create()
    {
        return view('orders.create');
    }
    public function store(OrderRequest $request)
    {
        do {

            $order_code ='BQ'.random_int(100000, 999999);

        } while (Order::where("order_code", "=", $order_code)->first());
        $data=[
            'order_code'=>$order_code,
            'user_id'=>$request->user_id,
            'course_id'=>$request->course_id,
            'status'=>Beesquad::PENDING,
            'amount'=>$request->amount
        ];
        Order::create($data);
        return redirect()->route('orders.list')->with('message','Thêm thành công');
    }
    public function show($order_id)
    {
        $order = Order::with('user','course')->find($order_id);
        return view('orders.detail',compact('order'));
    }
    public function selectCourse($course_id)
    {
        $course = Course::find($course_id);
        return response()->json($course);
    }
    public function searchUser(Request $request)
    {
        $users = User::orWhere('name','like',"%{$request->get('search')}%")
                            ->limit(20)
                            ->get();
        return response()->json($users);
    }
    public function checkVoucher($voucher)
    {
        $voucher = Voucher::where('name',$voucher)->get();
        if(!empty($voucher->toArray())){
            return response()->json([
                'status'=>true,
                'data'=>$voucher
            ]);
        }
        return response()->json([
            'status'=>false,
            'message'=>'Mã giảm giá không có hiệu lực'
        ]);
    }
    public function checkPayment($type,$order_id)
    {
        $order = Order::find($order_id);
        if($order){
            if($type == 1){
                //payment complete
                $order->update([
                    'status'=>Beesquad::DONE
                ]);
                $data = [
                    'user_id'=>$order->user_id,
                    'course_id'=>$order->course_id,
                    'status'=>0
                ];
                $checkStudy = Study::where('user_id',$order->user_id)
                ->where('course_id',$order->course_id)
                ->exists();
                if(!$checkStudy){
                    Study::create($data);
                }
                $userVoucher = UserVoucher::where('voucher_code',$order->voucher_code)->first();
                $userVoucher->update([
                    'is_used'=>1
                ]);
            }else{
                //cancel order
                $order->update([
                    'status'=>Beesquad::CANCEL
                ]);
            }
            return response()->json([
                'status'=>true,
                'message'=>'Cập nhật thành công'
            ]);
        }
        return response()->json([
            'status'=>false,
            'message'=>'Không tổn tại order'
        ]);
    }

}
