<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function detailLesson(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    public function trialLesson()
    {
        $lessons = Lesson::trailLesson()->get();
        return LessonResource::collection($lessons);
    }

}
