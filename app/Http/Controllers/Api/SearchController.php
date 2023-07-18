<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $param = $request->search;

        if ($param) {
            $courses = Course::where('name', 'LIKE', '%' . $param . '%')->get();

            $categories = Category::where('name', 'LIKE', '%' . $param . '%')->get();

            $blogs = Blog::where('title', 'LIKE', '%' . $param . '%')->get();

            return response([
                'data' => [
                    'categories' => CourseResource::collection($categories),
                    'courses' => CategoryResource::collection($courses),
                    'blogs' => BlogResource::collection($blogs),
                ],
            ], 200);
        } else {
            return response([
                'message' => 'Không tìm thấy'
            ], 200);
        }
    }
}
