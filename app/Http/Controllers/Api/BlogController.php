<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryBlogResource;
use App\Models\Beesquad;
use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function categoryBlog()
    {
        $blogs = CategoryBlog::with('blogs')->get();

        if (!$blogs) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => CategoryBlogResource::collection($blogs)
        ]);
    }
    public function blog()
    {
        $blogs = Blog::take(Beesquad::LIMIT)->get();
        if (!$blogs) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => BlogResource::collection($blogs)
        ]);
    }

    public function detailBlog(Blog $blog)
    {
        if (!$blog) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => new BlogResource($blog->load('category'))
        ]);
    }

}
