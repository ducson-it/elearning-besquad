<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::paginate(5);
        //xử lý link ảnh
        $sliders->getcollection()->transform(function ($item) {
            if (isset($item->image['disk']) && isset($item->image['path']))
                $item->image = Storage::disk($item->image['disk'])->url($item->image['path']);
            else
                $item->image = '/storage/anh.png';
            return $item;
        });
        return view('slider.list',compact('sliders'));
    }
    public function create(){
        return view('slider.create');
    }
    public function store(SliderRequest $request)
    {
        $data = $request->all();
        $media = session('sliders');
        $data['image'] = $media;
        Slider::create($data);
        return redirect()->route('slider.list')->with('success', 'Thêm slider thành công');
    }
    public function edit($id){
        $sliders = Slider::findOrFail($id);
        return view('slider.edit',compact('sliders'));
    }

    public function update(SliderRequest $request, $id)
    {
        $data = $request->all();
        $media = session('sliders');
        if ($media) {
            $data['image'] = $media['path'];
        }
        $slider = Slider::findOrFail($id);
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
