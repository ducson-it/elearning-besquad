<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function freeCourse()
    {
        $courses = Course::freeCourse()->get();

        return CourseResource::collection($courses);
    }

    public function paidCourse()
    {
        $courses = Course::paidCourse()->get();

        return CourseResource::collection($courses);
    }

    public function detailCourse(Course $course)
    {
        return new CourseResource($course);
    }

    public function myCourse()
    {
        $course = Course::all();
        return CourseResource::collection($course);
    }
}
