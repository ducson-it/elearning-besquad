<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $allowedExtensions = ['svg', 'png', 'jpg', 'jpeg'];
            $image = $request->file('avatar');
            $directory = 'public/avatars';
            $imageName = time() . '_' . $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            if (in_array($extension, $allowedExtensions)) {
                $path = $image->storeAs($directory, $imageName);
                return response()->json(['image_path' => $path]);
            } else {
                return response()->json(['error' => 'Not image'], 400);

            }
        }
        return response()->json(['error' => 'Invalid image'], 400);
    }
}
