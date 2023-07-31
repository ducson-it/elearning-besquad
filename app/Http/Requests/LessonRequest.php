<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'document'=>'required|size:10240',
            'course_id'=>'required',
            'module_id'=>'required'
            //
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"Tên không được để trống",
            'document.size'=>"Kích thước file quá lớn",
            'document.required'=>"Bạn chưa tải file",
            'course_id.required'=>"Bạn chưa chọn khoá học",
            'module_id.required'=>"Bạn chưa chọn chủ đề"
        ];
    }
}
