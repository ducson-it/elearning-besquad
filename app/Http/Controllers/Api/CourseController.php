<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;
use App\Models\Beesquad;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;
use PHPUnit\Framework\Constraint\Count;

class CourseController extends Controller
{
    public function categoryCourse()
    {
        $courses = Category::with('courses')->get();
        if (!$courses) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' =>CategoryResource::collection($courses)
        ]);
    }

    public function detailCourse(Course $course)
    {
        if (!$course) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => new CourseResource($course->load('modules', 'modules.lessons'))
        ]);
    }

    public function myCourse()
    {
        $userId = Auth::id();
        $courses =  User::find($userId)->courses()->with(['modules', 'modules.lessons', 'category'])->get();
        return response()->json([
            'success' => true,
            'courses' => $courses
        ], 200);
    }

    public function registerCourse(Request $request)
    {
        $courseId = $request->get('course_id', '');

        $course = Course::find($courseId);

        $user = Auth::user();

        $checkOrder = Order::where('course_id', $course->id)
                    ->Where('user_id', $user->id)
                    ->Where('course_id', $course->id)
                    ->Where('status', Beesquad::PENDING)
                    ->exists();

        if ($checkOrder) {
            return response(['success' => false, 'data' => [
                'message' => 'Đơn hàng đang trong thời gian xử lý'
            ]]);
        }
        if ($course) {
            if ($course->is_free == Beesquad::TRUE) {
                try {
                    DB::beginTransaction();
                    do {
                        $order_code = 'BQ' . random_int(100000, 999999);
                    } while (Order::where("order_code", "=", $order_code)->first());
                    $data = [
                        'order_code' => $order_code,
                        'user_id' => $user->id,
                        'course_id' => $courseId,
                        'status' => Beesquad::DONE,
                        'amount' => $course->price
                    ];
                    Order::create($data);
                    $course->users()->attach($user->id);
                    DB::commit();
                    return response(['success' => true, 'data' => [
                        'message' => 'Đăng ký thành công!'
                    ]]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return response([
                        'success' => false, 'data' => [
                            'message' => 'Đăng ký không thành công, vui lòng thử lại!'
                        ]
                    ]);
                }
            }
            if ($course->is_free == Beesquad::FALSE) {
                try {
                    DB::beginTransaction();
                    do {
                        $order_code = 'BQ' . random_int(100000, 999999);
                    } while (Order::where("order_code", "=", $order_code)->first());
                    $data = [
                        'order_code' => $order_code,
                        'user_id' => $user->id,
                        'course_id' => $courseId,
                        'status' => Beesquad::PENDING,
                        'amount' => $request->input('amount')
                    ];
                    Order::create($data);
                    DB::commit();
                    return response([
                        'success' => true, 'data' => [
                            'message' => 'Tạo thành công đơn hàng, mời bạn thanh toán!'
                        ]
                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return response(['success' => false, 'data' => [
                        'message' => 'Đơn hàng đang trong thời gian xử lý, vui lòng thử lại!'
                    ]]);
                }
            }
        }
    }
    // Pay by transfer
    public function checkPayment(Request $request)
    {
        $order_code = $request->input('order_code');
        $order = Order::where('order_code',$order_code)->first();
        if($order){
            if($order->status == Beesquad::DONE){
                return response()->json([
                    'status'=>true,
                    'message'=>'Đã thanh toán thành công'
                ],200);
            }
            if($order->status == Beesquad::PENDING){
                return response()->json([
                    'status'=>false,
                    'message'=>'Thanh toán của bạn đang trong quá trình xử lý'
                ]);
            }
        }
    }

    //Pay by VNPay

    public function redirectUrl(Request $request)
    {
        do {

            $order_code ='BQ'.random_int(100000, 999999);

        } while (Order::where("order_code", "=", $order_code)->first());
        $data=[
            'order_code'=>$order_code,
            'user_id'=>Auth::id(),
            'course_id'=>$request->input('course_id'),
            'status'=>Beesquad::PENDING,
            'amount'=>$request->input('amount')
        ];
        Order::create($data);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('callback');
        $vnp_TmnCode = "U4M0BXV2"; //Mã website tại VNPAY
        $vnp_HashSecret = "NXKEEFRVGQPRIDNZPHFVRUNZRYDSSDLM"; //Chuỗi bí mật
        $vnp_TxnRef = $order_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->input('course_id');
        $vnp_OrderType = 1;
        $vnp_Amount = $request->input('amount')*100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
        $vnp_ExpireDate = date('YmdHis', strtotime('+2 days', strtotime(date('YmdHis'))));
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            return response()->json(
                [
                    'data' => $vnp_Url,
                ]
                );

    }
    public function callback(Request $request) {
        if($request->vnp_TransactionStatus == 0){
            Order::where('order_code',$request->vnp_TxnRef)->update([
                'status'=>Beesquad::DONE
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Thanh toán thành công'
            ],200);
        }
    }
    
    public function historyCourse(Request $request)
    {
        $courseId = $request->get('course_id');
        return response()->json($courseId);
        // Lấy thông tin người dùng từ mã token xác thực
        $history =History::where('user_id',Auth::id())
            ->where('course_id',$courseId)
            ->get();
        $lesson_history_count = History::where('user_id',Auth::id())
        ->where('course_id',$courseId)
        ->count();
        $lesson_count = Lesson::where('course_id',$courseId)->count();
        if($lesson_count == 0){
            $lesson = Lesson::where('course_id',$courseId)->first();
            $history = $lesson;
            $complete_rate = round($lesson_history_count*100,2);
        }else{
            $complete_rate = round($lesson_history_count*100/$lesson_count,2);
        }
        return response()->json([
            'status' => true,
            'history' => $history,
            'complete_rate'=>$complete_rate
        ], 200);
    }
    public function historyCourseUpdate(Request $request)
    {
        $courseId = $request->input('course_id');
        $lessonId = $request->input('lesson_id');
        // Lấy thông tin người dùng từ mã token xác thực
        $history = History::where('course_id',$courseId)
            ->where('lesson_id',$lessonId)
            ->where('user_id',Auth::id())
            ->get();
        if(!isset($history)){
            $history = History::create([
                'user_id' => Auth::id(),
                'course_id' => $courseId,
                'lesson_id' => $lessonId,
                'status'=>1
            ]);
        }
        $lesson_history_count = History::where('user_id',Auth::id())
        ->where('course_id',$courseId)
        ->distinct('lesson_id')
        ->count();
        $lesson_count = Lesson::where('course_id',$courseId)->count();
        $complete_rate = round($lesson_history_count*100/$lesson_count,2);
        return response()->json([
            'message' => 'Lịch sử học đã được ghi lại thành công',
            'status'=>true,
            'history' => $history,
            'complete_rate'=>$complete_rate
        ], 200);
    }
}
