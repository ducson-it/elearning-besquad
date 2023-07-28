<?php

namespace App\Http\Controllers;

use App\Models\Beesquad;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //
    public function index()
    {
        $histories = History::with(['user','course','lesson'])->paginate(Beesquad::PAGINATE_BLOG);
        return view('histories',compact('histories'));
    }
}
