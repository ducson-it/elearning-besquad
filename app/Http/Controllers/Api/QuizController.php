<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function answerCheck(Request $request)
    {
        $question_id = $request->question_id;
        $answer_choose = $request->answer_id;
        $correct_answer = Answer::where('question_id',$question_id)
            ->where('correct_answer',1)
            ->first();
        if($answer_choose == $correct_answer->id){
            return response()->json([
                'status'=>true,
                'message'=>'Đáp án đúng',
                'data'=>$correct_answer
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Đáp án sai'
            ],200);
        }
    }
    public function viewAnswerCorrect(Request $request)
    {
        $question_id = $request->question_id;
        $correct_answer = Answer::where('question_id',$question_id)
            ->where('correct_answer',1)
            ->first();
        return response()->json([
            'status'=>true,
            'data'=>$correct_answer
        ],200);
    }
}
