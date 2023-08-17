<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function answerCheck(Request $request)
    {
        $data = [];
        $correct_answer = Answer
        ::where('correct_answer',1)
        ->get()->pluck('id')->toArray();
        foreach($request->answer_chooses as $value){
            if(!in_array($value['answer_choose'],$correct_answer)){
                array_push($data,$value['question_id']);
            }
        }
        return response()->json([
            'status'=>true,
            'data'=>$data
        ]);
        // if($answer_choose == $correct_answer->id){
        //     return response()->json([
        //         'status'=>true,
        //         'message'=>'Đáp án đúng',
        //         'data'=>$correct_answer
        //     ],200);
        // }else{
        //     return response()->json([
        //         'status'=>false,
        //         'message'=>'Đáp án sai'
        //     ],200);
        // }
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
    public function showQuizDetail(Quiz $quiz){
        if (!$quiz) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' =>new QuizResource($quiz->load('questions','questions.answers'))
        ]);
    }
}
