<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public  function mediaUpload(Request $request){
        $file = $request->file('file');
        $path = $file->store('media','public');
        $image = [
                'disk'=>"public",
                'path'=>$path
            ];
        $image['path'] = Storage::disk($image['disk'])->url($image['path']);
        return response()->json($image);
    }
    //upload ảnh trong sliders
    public function mediaUpload2(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('sliders', 'public');
        $image = [
            'disk' => "public",
            'path' => $path
        ];
        session()->put('sliders', $image);
        return response()->json($image, 200);
    }

}
