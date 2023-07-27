<?php

namespace App\Http\Controllers;

use App\Models\Beesquad;
use App\Models\Study;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    //
    public function index()
    {
        $studies = Study::with(['user','course'])->paginate(Beesquad::PAGINATE_BLOG);
        return view('studies',compact('studies'));
    }
}
