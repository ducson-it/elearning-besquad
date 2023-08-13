<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Support\Facades\Auth;

class FeebackController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $feedbacks = Feedback::where('content', 'like', '%' . $search . '%')->paginate(8);
        return view ('feedbacks.list',compact('feedbacks'));
    }
    public function create(){
        $feedbacks = Feedback::all();
        return view ('feedbacks.create',compact('feedbacks'));
    }
    public function store(FeedbackRequest $request){
        $data = $request->all();
        $user_id = Auth::user()->id;
        $data['user_id'] = $user_id;
        $data['view'] = 0;
        $data['star'] = 0;
        Feedback::create($data);
        return redirect()->route('feedbacks.list')->with('success', 'Thêm đánh giá thành công');
    }
    public function edit($id){
        $feedbacks = Feedback::find($id);
        return view ('feedbacks.edit',compact('feedbacks'));
    }
    public function update(FeedbackRequest $request, $id){
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return redirect()->route('feedbacks.list')->with('error', 'Không tìm thấy đánh giá');
        }
        $data = $request->all();
        $feedback->update($data);
        return redirect()->route('feedbacks.list')->with('success', 'Cập nhật đánh giá thành công');
    }
    public function destroy($id){
        $feedback = Feedback::findOrFail($id);
        if($feedback->delete()){
            return response()->json(['message' => 'Xóa đánh giá thất bại '], 200);
        }
        return redirect()->route('feedbacks.list')->with('success', 'Xóa đánh giá thành công');
    }
}
