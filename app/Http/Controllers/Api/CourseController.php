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
                        'amount' => $course->price
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
                        'message' => 'Tạo không thành công đơn hàng, vui lòng thử lại!'
                    ]]);
                }
            }
        }
    }

    public function historyCourse(Request $request)
    {
        $courseId = $request->input('course_id');
        $lessonId = $request->input('lesson_id');
        $time = $request->input('time');
        $stopTimeVideo = $request->input('stop_time_video');
        // Lấy thông tin người dùng từ mã token xác thực
        $user = auth()->user();
        $history = History::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'lesson_id' => $lessonId,
            'time' => Carbon::parse($time),
            'stop_time_video' => Carbon::parse($stopTimeVideo),
        ]);
        return response()->json([
            'message' => 'Lịch sử học đã được ghi lại thành công',
            'history' => $history
        ], 200);
    }
}
