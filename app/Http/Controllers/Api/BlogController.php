<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryBlogResource;
use App\Models\Beesquad;
use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\Constant;
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
        $blogs = Blog::paginate(2);
        if (!$blogs) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => new BlogCollection($blogs)
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
