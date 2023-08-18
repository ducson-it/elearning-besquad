<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Models\Beesquad;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ModuleController extends Controller
{

    //
    public function index(Request $request)
    {
        $keyword = '';
        $user = Auth::user();

        if ($user->hasRole(3)) {
            $modules = Module::with('course')->whereHas('course', function($query) use($user){
                $query->where('teacher_id', $user->id);
            });
        } else {
            $modules = Module::with('course');
        }
        if($request->get('keyword')){
            $keyword = $request->get('keyword');
            $modules = $modules->where('name','like',"%{$keyword}%")
                            ->orWhereHas('course',function($q) use ($keyword){
                                $q->where('name','like',"%{$keyword}%");
                            });
        }
        $modules = $modules->orderBy('id','desc')->paginate(Beesquad::PAGINATE_BLOG);
        return view('modules.list',compact('modules','keyword'));
    }
    public function create()
    {
        return view('modules.create');
    }
    public function store(ModuleRequest $request)
    {
        $data=[
            'name'=>$request->name,
            'slug'=>$request->slug,
            'course_id'=>$request->course_id,
            'description'=>$request->content
        ];
        Module::create($data);
        return redirect()->route('modules.list')->with('message','Thêm thành công');
    }
    public function edit(Module $module)
    {
        return view('modules.edit',compact('module'));
    }
    public function update(Module $module,ModuleRequest $request)
    {
        $data=[
            'name'=>$request->name,
            'slug'=>$request->slug,
            'course_id'=>$request->course_id,
            'description'=>$request->content
        ];
        $module->update($data);
        return redirect()->route('modules.list')->with('message','Cập nhật thành công');
    }
    public function destroy($module_id)
    {
        $module = Module::find($module_id);
        $module->delete();
        $module->lessons()->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công'
        ]);
    }
    public function searchCourse(Request $request)
    {
        $courses = Course::orWhere('name','like',"%{$request->get('search')}%")
                            ->limit(20)
                            ->get();
        return response()->json($courses);
    }
}
