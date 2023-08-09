<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
            $search = $request->input('search');
            $comments = Comment::where('content', 'like', '%' . $search . '%')->paginate(8);
        return view('comments.list', compact('comments'));
    }
    public function create(){
        $posts = Post::all();
        $lessons = Lesson::all();
        $courses = Course::all();
        // Truyền dữ liệu sang view
        return view('comments.create',compact('posts', 'lessons', 'courses'));
    }
    public function store(CommentRequest $request)
    {
        // Lấy nội dung comment từ trường "content" trong request
        $commentContent = $request->input('content');
        // Lấy danh sách các bảng được chọn
        $selectedTables = $request->input('tables');
        // Lưu comment vào bảng comments
        $comment = new Comment();
        $comment->content = $commentContent;
        $comment->user_id = Auth::id();
        $comment->status = 0;

        // Thiết lập giá trị "commentable_type" tùy thuộc vào checkbox được chọn
        if (in_array('posts', $selectedTables)) {
            $commentable = Post::find($request->input('post_id'));
            if ($commentable) {
                $comment->commentable_type = Post::class;
                $comment->commentable_id = $commentable->id;
            }
        }
        if (in_array('lessons', $selectedTables)) {
            $commentable = Lesson::find($request->input('lesson_id'));
            if ($commentable) {
                $comment->commentable_type = Lesson::class;
                $comment->commentable_id = $commentable->id;
            }
        }
        if (in_array('courses', $selectedTables)) {
            $commentable = Course::find($request->input('course_id'));
            if ($commentable) {
                $comment->commentable_type = Course::class;
                $comment->commentable_id = $commentable->id;
            }
        }
        $comment->save();
        return redirect()->route('comment.list')->with('success', 'Thêm comment thành công');
    }

    public function update($id)
    {
        $comment = Comment::find($id);
        try{
            if($comment->status == 0){
                $comment->update([
                    'status' => 1
                ]);
            }else{
                $comment->update([
                    'status' => 0
                ]);
            }
            return redirect()->route('comment.list')->with('success', ' Thành công');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Thất bại');
        }
    }
    public function delete($id){
        $comments = Comment::findOrFail($id);
        if($comments->delete()){
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        }
        return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
    }
}
