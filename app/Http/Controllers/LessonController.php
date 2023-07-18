<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    //
    public function index()
    {
        $lessons = Lesson::with('module','module')->paginate(5);
        return view('lessons.list',compact('lessons'));
    }
    public function create()
    {
        //get video from sproud video
        $videos = Http::withHeaders([
            'SproutVideo-Api-Key'=>'699701dc7639206852db31e119899bdf',
            'Content-Type'=>'application/json'
        ])->get('https://api.sproutvideo.com/v1/videos');
        $videos = json_decode($videos,TRUE);
        return view('lessons.create',$videos);
    }
    public function store(Request $request)
    {
        $documentName = '';
            if($request->file('document') != ''){
                $document = $request->file('document');
                $documentName = $document->getClientOriginalName();
                $document->storeAs('document',$documentName,'public');
            };
            $data = [
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'course_id'=>$request->course_id,
                'module_id'=>$request->module_id,
                'document'=>$documentName,
                'video_id'=>$request->video_id,
                'status'=>1,
                'description'=>$request->content,
                'view'=>0,
                'is_trial_lesson'=>$request->is_trial_lesson
            ];
            Lesson::create($data);
            return redirect()->route('lessons.list');
    }
    public function edit(Lesson $lesson)
    {
        $videos = Http::withHeaders([
            'SproutVideo-Api-Key'=>'699701dc7639206852db31e119899bdf',
            'Content-Type'=>'application/json'
        ])->get('https://api.sproutvideo.com/v1/videos');
        $videos = json_decode($videos,TRUE);
        //get detail video
        $video = Http::withHeaders([
            'SproutVideo-Api-Key'=>'699701dc7639206852db31e119899bdf',
            'Content-Type'=>'application/json'
        ])->get('https://api.sproutvideo.com/v1/videos/'.$lesson->video_id);
        $video = json_decode($video,TRUE);
        return view('lessons.edit',compact('lesson','video'),$videos);
    }
    public function update(Request $request,Lesson $lesson)
    {
        if($request->file('document') != ''){
            $document = $request->file('document');
            $documentName = $document->getClientOriginalName();
            $document->storeAs('document',$documentName,'public');
        }else{
            $documentName = $lesson->document;
        };
        $data = [
            'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'course_id'=>$request->course_id,
                'module_id'=>$request->module_id,
                'document'=>$documentName,
                'video_id'=>$request->video_id,
                'status'=>1,
                'description'=>$request->content,
                'view'=>0,
                'is_trial_lesson'=>$request->is_trial_lesson
        ];
        $lesson->update($data);
        return redirect()->route('lessons.list')->with('message','Cập nhật thành công');
    }
    public function destroy($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        $lesson->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công'
        ]);
    }
    //download file
    public function downloadDoc($file)
    {
        $path = 'storage/document/'.$file;
        return response()->download($path);
    }
    public function selectModule(Request $request)
    {
        $course_id = $request->course_id;
        $modules = Module::where('course_id',$course_id)->get();
        return response()->json($modules);
    }
    // public function uploadVideo(Request $request)
    // {
    //     $source_video = $request->file('file');
    //     $source_video = json_encode($source_video);
    //     $video = Http::withHeaders([
    //         'SproutVideo-Api-Key'=>'699701dc7639206852db31e119899bdf',
    //         'Content-Type'=>'multipart/form-data',
    //     ])->post('https://api.sproutvideo.com/v1/videos',[
    //         'source_video'=>$source_video
    //     ]);
    //     return $video;
    // }
}
