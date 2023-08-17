<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'is_free'=>'required',
            'category_id'=>'required',
            'filepath'=>'required',
            'featured'=>'required',
            'content'=>'required',
            'teacher_id'=>'required',
            'playlist_id'=>'required'
            //
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"Tên không được để trống",
            'is_free.required'=>"Bạn chưa chọn loại khoá học",
            'category_id.required'=>"Bạn chưa chọn danh mục",
            'filepath.required'=>"Bạn chưa tải file",
            'featured.required'=>"Mô tả chung không được để trống",
            'content.required'=>"Mô tả không được để trống",
            'teacher_id.required'=>"Chọn giảng viên",
            'playlist_id.required'=>"Chọn playlist khóa học",
            //
        ];
    }
}
