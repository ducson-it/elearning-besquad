<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class ForumFeedbackController extends Controller
{
    public function list(){
        $feedbacks = Feedback::with('user:id,name')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Thành công',
            'data' => $feedbacks,
        ]);
    }

    public function detail($id)
    {
        $feedbacks = Feedback::with('user:id,name')->findOrFail($id);
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data'=> $feedbacks
        ]);
    }
    public function addfeedback(Request $request){
        $userId = $request->input('user_id');
        $user = User::find($userId);
        $data = [
            'content'=> $request->input('content'),
            'title'=>$request->input('title'),
            'user_id' => $user->id,
            'name' => $user->name,
            'view'=>  0,
            'star'=> 0,
        ];
        $resulf = Feedback::create($data);
        if($resulf){
            return response()->json([
                'status'=> true,
                'message'=>'Đã tạo feedback  thành công',
                'data'=> $data
            ],201);
        }else{
            return response()->json([
                'status'=> false,
                'message'=>'Feedback thất bại',
            ],500);
        }
    }
    public function edit(Request $request, $id)
    {
        $userId = $request->input('user_id');
        if (!$userId) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không phải người dùng của hệ thống'
            ], 404);
        }
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json([
                'status' => false,
                'message' => 'Phản hồi không tồn tại'
            ], 404);
        }

        // Đảm bảo chỉ người tạo phản hồi mới được phép sửa
        if ($feedback->user_id !== $userId) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không được phép sửa phản hồi của người khác'
            ], 403);
        }
        $data = [
            'content' => $request->input('content', $feedback->content),
             'title' => $request->input('title', $feedback->title)
        ];

        $result = $feedback->update($data);
        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'Đã sửa phản hồi thành công',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sửa phản hồi thất bại',
            ], 500);
        }
    }

    public function delete($id)
    {
        $userId = Auth::user()->id;
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json([
                'status' => false,
                'message' => 'Phản hồi không tồn tại'
            ], 404);
        }
        if ($feedback->user_id !== $userId) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không được phép xóa phản hồi của người khác'
            ], 403);
        }
        // Thực hiện xóa phản hồi
        $result = $feedback->delete();
        if ($result) {
            return response()->json([
                'status' => true,
                'message' => 'Đã xóa phản hồi thành công',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Xóa phản hồi thất bại',
            ], 500);
        }
    }
    public function addview($id){
        $feedback = Feedback::find($id);
        $user = Auth::user();
        if(!$feedback){
            return response()->json([
                'status'=>403,
                'meesage'=> 'không tồn tại feedback này',
            ]);
        }else{
            $count = $feedback->view+ 1;
            $feedback->update(['view'=>$count]);
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => ['feedback' => $feedback, 'user' => $user]
            ]);
        }

    }

}
