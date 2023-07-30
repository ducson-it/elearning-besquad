<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Models\Answer;
use App\Models\Beesquad;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function index(Request $request)
    {
        $quizzes = Quiz::with('courses','modules')->orderBy('id','desc');
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
            $quizzes = $quizzes->where('name','like',"%{$keyword}%");
        }
        $quizzes = $quizzes->paginate(Beesquad::PAGINATE_BLOG);
        return view('quiz.list',compact('quizzes','keyword'));
    }
    public function create()
    {
        $quizTypes = Beesquad::QUIZ_TYPE;
        return view('quiz.create',compact('quizTypes'));
    }
    public function store(QuizRequest $request)
    {
        $data = $request->all();
        Quiz::create($data);
        return redirect()->route('quiz.list')->with('message','Thêm thành công');
    }
    public function edit(Quiz $quiz)
    {
        $quizTypes = Beesquad::QUIZ_TYPE;
        return view('quiz.edit',compact('quiz','quizTypes'));
    }
    public function update(Quiz $quiz,QuizRequest $request)
    {
        $data = $request->all();
        $quiz->update($data);
        return redirect()->route('quiz.list')->with('message','Cập nhật thành công');
    }
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        $questions = Question::where('quiz_id',$quiz->id);
        if($questions){
            $questions->delete();
        }
        $question_id = Question::where('quiz_id',$quiz->id)->get()->pluck('id');
        $answers = Answer::whereIn('question_id',$question_id);
        if($answers){
            $answers->delete();
        }
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công'
        ]);
    }
}
