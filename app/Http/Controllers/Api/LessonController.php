<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function trailLesson()
    {
        $lessons = Lesson::trialLesson()->get();
        if (!$lessons) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => LessonResource::collection($lessons)
        ]);
    }

    public function detailLesson(Lesson $lesson)
    {
        if (!$lesson) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => new LessonResource($lesson->load('module','course','course.modules','course.modules.lessons','course.quiz','course.quiz.questions','course.quiz.questions.answers'))
        ]);
    }

}
