<?php

namespace App\Http\Controllers;
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
        $comments = Comment::paginate(5);
        if ($request->has('search')) {
            $search = $request->input('search');
            $comments = Comment::where('content', 'like', '%' . $search . '%')->paginate(5);
        }
        return view('comments.list', compact('comments'));
    }
    public function create(){
        $posts = Post::all();
        $lessons = Lesson::all();
        $courses = Course::all();
        // Truyền dữ liệu sang view
        return view('comments.create',compact('posts', 'lessons', 'courses'));
    }
    public function store(Request $request)
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


    public function edit($id){
        $comments=Comment::find($id);
        return view('comments.edit',compact('comments'));
    }
    public function update(Request $request, $id)
    {
        $status = $request->input('status');
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('comment.list')->with('success','Sửa trạng thái thất bại');
        }
        // Chuyển đổi trạng thái thành 1 nếu chọn "active" và thành 0 nếu chọn "inactive"
        $comment->status = ($status == 'active') ? 1 : 0;
        $comment->save();
        // Xử lý thành công
        return redirect()->route('comment.list')->with('success','Sửa trạng thái thành công');
    }
    public function delete($id){
        $comments = Comment::findOrFail($id);
        if($comments->delete()){
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        }
        return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
    }
}
