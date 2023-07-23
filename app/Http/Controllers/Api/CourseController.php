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
use Illuminate\Support\Facades\Auth;

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
        $courseId = $request->input('course_id');
        if (!$courseId) {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $lesson = Lesson::where('course_id', $courseId)->first();
        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }
        return response()->json([
            'lesson_id' => $lesson->id,
        ], 200);
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
            'user_id' => Auth()->id,
            'course_id' => $courseId,
            'lesson_id' => $lessonId,
            'status'=>1
        ]);
        $lesson_history_count = History::where('user_id',Auth::id())
        ->where('course_id',$courseId)
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
