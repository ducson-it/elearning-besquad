<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id'=>'required',
            'course_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            //
            'user_id.required'=>'Tên user không được để trống',
            'course_id.required'=>'Khoá học không được để trống'
        ];
    }
}
