<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            //
            'name'=>'required',
            'course_id'=>'required',
            'quiz_type'=>'required'
        ];

    }
    public function messages()
    {
        return [
            //
            'name.required'=>'Tên không được để trống',
            'course_id.required'=>'Bạn chưa chọn khoá học',
            'quiz_type.required'=>'Bạn chưa chọn loại đề'
        ];
        
    }
}
