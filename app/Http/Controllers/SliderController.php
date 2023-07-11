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
    public function store(SliderRequest $request)
    {
        $data = $request->all();
        Slider::create($data);
        return redirect()->route('slider.list')->with('success', 'Thêm sliders thành công.');
    }

    public function edit($id){
        $sliders = Slider::findOrFail($id);
        return view('slider.edit',compact('sliders'));
    }

    public function update( Request $request , $id){
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
