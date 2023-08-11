<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request)
    {
            $search = $request->input('search');
            $sliders = Slider::where('name', 'like', '%' . $search . '%')->paginate(8);
        return view('slider.list', compact('sliders'));
    }
    public function create(){
        return view('slider.create');
    }
    public function store(SliderRequest $request)
    {
        $data = $request->all();
        $data['image']=$request->filepath;
        Slider::create($data);
        return redirect()->route('slider.list')->with('success', 'Thêm slider thành công');
    }
    public function edit($id){
        $sliders = Slider::findOrFail($id);
        return view('slider.edit',compact('sliders'));
    }
    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $request->all();
        $data['image']=$request->filepath;
        $slider->update($data);
        return redirect()->route('slider.list')->with('success', 'Cập nhật slider thành công');
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
