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
    //User login get courses in studies to check myCourse
    public function getCourse()
    {
            $courses = Course::with(['category','studies'])->get();
            if (!$courses) {
                return response()->json([
                    'code' => 404,
                    'message' => 'note found'
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $courses,
            ]);
    
    }
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
            'data' => CategoryResource::collection($courses)
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

    
    public function historyCourse(Request $request)
    {
        $courseId = $request->input('course_id');
        // Lấy thông tin người dùng từ mã token xác thực
        $history =History::where('user_id',Auth::id())
            ->where('course_id',$courseId)
            ->get();
        $lesson_history_count = History::where('user_id',Auth::id())
        ->where('course_id',$courseId)
        ->count();
        $lesson_count = Lesson::where('course_id',$courseId)->count();
        $complete_rate = round($lesson_history_count*100/$lesson_count,2);
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
        $history = History::create([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
            'lesson_id' => $lessonId,
            'status'=>1
        ]);
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
