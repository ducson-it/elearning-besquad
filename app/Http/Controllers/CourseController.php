<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    //list courses
    public function index(){
        $courses = Course::with('category')->paginate(5);
        return view('courses.list',compact('courses'));
    }
    //view create courses
    public function create(){
        $categories = Category::pluck('name','id')->all();
        return view('courses.create',compact('categories'));
    }
    public function store(CourseRequest $request){
        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>1,
            'featured'=>$request->featured,
            'category_id'=>$request->category_id,
            'image'=>$request->filepath,
            'description'=>$request->content,
        ];
        Course::create($data);
        return redirect()->route('courses.list')->with('message','Thêm thành công');
    }
    public function edit(Course $course){
        $categories = Category::pluck('name','id');
        return view('courses.edit',compact('course','categories'));
    }
    public function update(Course $course,CourseRequest $request){
        $data = [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'featured'=>$request->featured,
            'category_id'=>$request->category_id,
            'image'=>$request->filepath,
            'description'=>$request->content
        ];
        $course->update($data);
        return redirect()->route('courses.list')->with('message',"Cập nhật thành công");
    }
    public function destroy($course_id){
        $course = Course::find($course_id);
        $course->delete();
        return response()->json([
            'status'=>true,
            'message'=>"Xoá thành công"
        ]);
    }
}
