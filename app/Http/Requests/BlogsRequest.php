<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogsRequest extends FormRequest
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
            'slug' => 'required',
            'description_short' => 'required',
            'content' => 'required',
            'category_blog_id'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'slug.required' => 'Vui lòng nhập slug bài viết',
            'description_short.required' => 'Vui lòng nhập mô tả ngắn gọn cho bài viết',
            'content.required' => 'Vui lòng nhập nội dung bài viết',
            'category_blog_id.required'=>'vui lòng chọn chủ đề'
        ];
    }
}
