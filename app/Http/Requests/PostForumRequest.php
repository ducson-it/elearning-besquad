<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostForumRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'type' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => "Không được để trống tiêu đề",
            'content.required' => "Không được để trống nội dung",
            'category_id.required' => "Không được để trống danh mục",
            'type.required' => "Không được để trống kiểu",
        ];
    }
}
