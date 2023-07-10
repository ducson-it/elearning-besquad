<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::paginate(5);
        return view('slider.list',compact('sliders'));
    }
    public function create(){
        return view('slider.create');
    }
    public function store(){

    }
    public function edit($id){
        $sliders = Slider::findOrFail($id);
        return view('slider.edit',compact('sliders'));
    }

    public function update( Request $request , $id){
    }
    public function destroy($id)
    {
        try {
            $sliders = Slider::findOrFail($id);
            $sliders->delete();
            return response()->json(['message' => 'Xóa bản ghi thành công'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Xóa bản ghi thất bại'], 500);
        }
    }


}
