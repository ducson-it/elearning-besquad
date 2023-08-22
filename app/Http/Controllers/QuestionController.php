<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Answer;
use App\Models\Beesquad;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:questions.list|questions.store|questions.update|questions.destroy', ['only' => ['index']]);
        $this->middleware('permission:questions.store', ['only' => ['create','store']]);
        $this->middleware('permission:questions.update', ['only' => ['edit','update']]);
        $this->middleware('permission:questions.destroy', ['only' => ['destroy']]);
    }

    public function index($quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        $questions= Question::where('quiz_id',$quiz_id)->orderBy('id','desc')->paginate(Beesquad::PAGINATE_BLOG);
        return view('quiz.detail',compact('questions','quiz'));
    }
    public function store(CategoryRequest $request,$quiz_id)
    {
        $data = $request->all();
        $data['quiz_id'] = $quiz_id;
        Question::create($data);
        return response()->json([
            'status'=>true,
            'message'=>'Thêm thành công'
        ]);
    }
    public function update($quiz_id,Question $question,CategoryRequest $request)
    {
        $data = $request->all();
        $question->update($data);
        return response()->json([
            'status'=>true,
            'message'=>'Cập nhật thành công'
        ]);
    }
    public function destroy($quiz_id,Question $question)
    {
        $question->delete();
        $answers = Answer::where('question_id',$question->id);
        if($answers){
            $answers->delete();
        }
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công'
        ]);
    }
}
