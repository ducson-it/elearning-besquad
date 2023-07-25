<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Beesquad;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    //list courses
    public function index(Request $request){
        $courses = Course::with('category');
        $keyword = '';
        if($request->get('keyword')){
            $keyword = $request->get('keyword');
            $courses = $courses->where('name','like',"%{$keyword}%");
        }
        $courses = $courses->orderBy('id','desc')->paginate(Beesquad::PAGINATE_BLOG);
        $categories = Category::all();
        return view('courses.list',compact('courses','categories','keyword'));
    }
    //view create courses
    public function create(){
        $courseTypes = Course::$courseType;
        $categories = Category::pluck('name','id')->all();
        return view('courses.create',compact('courseTypes','categories'));
    }
    public function store(CourseRequest $request){
        if($request->is_free == 0){
            $request->price = 0;
            $request->discount = 0;
        };
        $data = [
            'name'=>$request->name,
            'slug'=>$request->slug,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>1,
            'featured'=>$request->featured,
            'category_id'=>$request->category_id,
            'image'=>$request->filepath,
            'description'=>$request->content,
            'is_free'=>$request->is_free
        ];
        Course::create($data);
        return redirect()->route('courses.list')->with('message','Thêm thành công');
    }
    public function edit(Course $course){
        $categories = Category::pluck('name','id');
        $courseTypes = Course::$courseType;
        return view('courses.edit',compact('course','categories','courseTypes'));
    }
    public function update(Course $course,CourseRequest $request){
        $data = [
            'name'=>$request->name,
            'slug'=>$request->slug,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'featured'=>$request->featured,
            'category_id'=>$request->category_id,
            'image'=>$request->filepath,
            'description'=>$request->content,
            'is_free'=>$request->is_free
        ];
        $course->update($data);
        return redirect()->route('courses.list')->with('message',"Cập nhật thành công");
    }
    public function destroy($course_id){
        $course = Course::find($course_id);
        $course->delete();
        $course->modules()->delete();
        $course->lessons()->delete();
        return response()->json([
            'status'=>true,
            'message'=>"Xoá thành công"
        ]);
    }
    //filter courses by category
    public function showCourseCate($category_id)
    {
        $courses = Course::with('category')->where('category_id',$category_id)->get();
        return response()->json($courses);
    }
    public function showAllCourseCate(){
        $courses = Course::with('category')->get();
        return response()->json($courses);
    }
}
