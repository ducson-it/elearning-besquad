<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with('user','course')->paginate(5);
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

        } while (Order::where("order_id", "=", $order_code)->first());
        $data=[
            'order_id'=>$order_code,
            'user_id'=>$request->user_id,
            'course_id'=>$request->course_id,
            'amount'=>$request->amount
        ];
        Order::create($data);
        return redirect()->route('orders.list')->with('message','Thêm thành công');
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

}
