<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentReplied;
use App\Models\User;
class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('replies','user','course')->get();
        $commentArray = [];
        foreach ($comments as $comment) {
            if ($comment->parent_id === null) {
                $commentItem = [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                    ],
                    'course' => $comment->course
                        ? [
                            'id' => $comment->course->id,
                            'name' => $comment->course->name,
                        ]
                        : null,
                    'replies' => [],
                ];
                foreach ($comment->replies as $reply) {
                  //comment con ko có replies nhé
                    $commentItem['replies'][] = [
                        'id' => $reply->id,
                        'content' => $reply->content,
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                        ],
                        'course' => $comment->course
                            ? [
                                'id' => $comment->course->id,
                                'name' => $comment->course->name,
                            ]
                            : null,
                    ];
                }
                $commentArray[] = $commentItem;
            }
        }
        return response()->json(['comments' => $commentArray], 200);
    }
    public function store(Request $request)
    {
        $replyContent = $request->input('content');
        $commentId = $request->input('comment_id');
        $userId = $request->input('user_id');
        $courseId = $request->input('course_id');
        $comment = Comment::find($commentId);
        $reply = Comment::create([
            'content' => $replyContent,
            'user_id' => $userId,
            'commentable_id' => $courseId,
            'commentable_type' => Course::class,
            'parent_id' => null,
            'status' => 1,
        ]);
        $userName = $reply->user->name;
        if ($comment) {
            $reply->parent_id = $comment->id;
            $reply->save();
        }
        return response()->json([
            'success' => 'Comment thành công',
            'reply' => ['user_name' => $userName,
             'content' => $replyContent]], 201);
    }
    public function update(Request $request, $id)
    {
        $replyContent = $request->input('content');
        $userId = $request->input('user_id');
        $reply = Comment::findOrFail($id);
        // Kiểm tra xem user_id của reply có trùng với user_id trong request không
        if ($reply->user_id != $userId) {
            return response()->json(['error' => 'Bạn không có quyền cập nhật comment này'], 403);
        }
        $reply->content = $replyContent;
        $reply->save();
        return response()->json(['success' => 'Cập nhật comment thành công', 'reply' => $reply], 200);
    }


    public function destroy( Request $request , $id)
    {
        $userId = $request->input('user_id');
        $comment = Comment::findOrFail($id);
        // Kiểm tra xem user_id của comment có trùng với user_id trong request không
        if ($comment->user_id != $userId) {
            return response()->json(['error' => 'Bạn không có quyền xóa comment này'], 403);
        }
        // Nếu comment cha bị xóa, xóa cả các comment con có parent_id là id của comment cha
        if ($comment->parent_id === null) {
            Comment::where('parent_id', $comment->id)->delete();
        }
        $comment->delete();
        return response()->json(['success' => 'Xóa comment thành công'], 200);
    }
}
