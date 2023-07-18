<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ModuleController extends Controller
{
 
    //
    public function index()
    {
        $modules = Module::with('course')->paginate(5);
        return view('modules.list',compact('modules'));
    }
    public function create()
    {
        $courses = Course::pluck('name','id');
        return view('modules.create',compact('courses'));
    }
    public function store(ModuleRequest $request)
    {
        $data=[
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
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
            'slug'=>Str::slug($request->name),
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
