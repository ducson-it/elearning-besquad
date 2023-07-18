<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\History;
use Carbon\Carbon;

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
            'data' => new CourseResource($course->load('modules','modules.lessons'))
        ]);
    }

    public function myCourse(){

    }
    public function registerCourse(Request $request){
        // Kiểm tra giá trị course_id và token từ header
        $courseId = $request->header('course_id');
        $token = $request->header('token');
        if (!$courseId || !$token) {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $lesson = Lesson::where('course_id', $courseId)->first();
        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }
        return response()->json([
            'token' => $token,
            'lesson_id' => $lesson->id,
        ], 200);
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

        return response()->json(['message' => 'Lịch sử học đã được ghi lại thành công',
            'history' => $history], 200);
    }







}
