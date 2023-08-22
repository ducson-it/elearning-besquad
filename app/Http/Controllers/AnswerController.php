<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Answer;
use App\Models\Beesquad;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:answers.list|answers.store|answers.update|answers.distroy', ['only' => ['index']]);
        $this->middleware('permission:answers.store', ['only' => ['store']]);
        $this->middleware('permission:answers.update', ['only' => ['update']]);
        $this->middleware('permission:answers.destroy', ['only' => ['destroy']]);
    }

    public function index($question_id)
    {
        $question = Question::find($question_id);
        $answers = Answer::where('question_id',$question_id)->orderBy('id','desc')->get();
        return view('quiz.question-answer',compact('answers','question'));
    }
    public function store(CategoryRequest $request,$question_id)
    {
        $data = $request->all();
        $data['question_id'] = $question_id;
        Answer::create($data);
        return response()->json([
            'status'=>true,
            'message'=>'Thêm thành công'
        ]);
    }
    public function update($question_id,Answer $answer,CategoryRequest $request)
    {
        $data = $request->all();
        $answer->update($data);
        return response()->json([
            'status'=>true,
            'message'=>'Cập nhật thành công'
        ]);
    }
    public function destroy($question_id,Answer $answer)
    {
        $answer->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công'
        ]);
    }
}
