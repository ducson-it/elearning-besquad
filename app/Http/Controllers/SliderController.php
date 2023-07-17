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
        $sliders = Slider::paginate(5);
        if ($request->has('search')) {
            $search = $request->input('search');
            $sliders = Slider::where('name', 'like', '%' . $search . '%')->paginate(5);
        }
        // Xử lý link ảnh
        $sliders->getCollection()->transform(function ($item) {
            if (isset($item->image['disk']) && isset($item->image['path'])) {
                $item->image = Storage::disk($item->image['disk'])->url($item->image['path']);
            } else {
                $item->image = '/storage/anh.png';
            }
            return $item;
        });

        return view('slider.list', compact('sliders'));
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
        if (isset($sliders->image['disk']) && isset($sliders->image['path'])) {
            $sliders->image = Storage::disk($sliders->image['disk'])->url($sliders->image['path']);
        } else {
            $sliders->image = '/storage/anh.png';
        }
        return view('slider.edit',compact('sliders'));
    }
    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $request->all();
        $media = session('sliders');
        if ($media) {
            $data['image'] = $media;
        }
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
