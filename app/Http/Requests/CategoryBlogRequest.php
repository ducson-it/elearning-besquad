<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryBlogRequest extends FormRequest
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
            'name' => 'required|unique:category_blogs,name|max:255',
            'slug' => 'required',
            'description' => 'required',
        ];
    }
        public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.unique' => 'Tên đã tồn tại.',
            'slug.required' => 'Slug không được để trống.',
            'description.required' => 'Vui lòng nhập mô tả.',
        ];
    }

}
