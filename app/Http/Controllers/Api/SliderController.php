<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function slider()
    {
        $sliders = Slider::activeSlider()->get();
        if (!$sliders) {
            return response()->json([
                'code' => 404,
                'message' => 'note found'
            ]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => SliderResource::collection($sliders)
        ]);
    }
}
