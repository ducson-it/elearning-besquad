<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::paginate(5);
        return view('slider.list',compact('sliders'));
    }
    public function create(){
        return view('slider.create');
    }
    public function store(Request $request)
    {
        $validateData= $request->validate([
            'name' => 'required',
            'content' => 'required',
            'text_color' => 'required',
            'url_btn' => 'required',
            'content_btn' => 'required',
            'image' => 'required|image',
            'status' => 'required',

        ],[
            'name.required' => 'Vui lòng nhập tên.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'text_color.required' => 'Vui lòng nhập màu chữ cho nút.',
            'url_btn.required' => 'Vui lòng nhập URL cho nút.',
            'content_btn.required' => 'Vui lòng nhập nội dung cho nút.',
            'image.required' => 'Vui lòng chọn ảnh.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ]);
        Slider::create([
            'name'=>$request->name,
            'content'=>$request->content,
            'text_color'=>$request->text_color,
            'url_btn'=>$request->url_btn,
            'content_btn'=>$request->content_btn,
            'status'=>$request->status,
        ]);
        return redirect()->route('slider.list')->with('success','Thêm slider thành công');
    }
    public function edit($id){
        $sliders = Slider::findOrFail($id);
        return view('slider.edit',compact('sliders'));
    }

    public function update(SliderRequest $request, $id)
    {

    }
    public function delete($id)
    {
            $sliders = Slider::findOrFail($id);
            if($sliders->delete()){
                return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
            }
            return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
    }


}
