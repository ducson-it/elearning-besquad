<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'content' => 'required',
            'text_color' => 'required',
            'url_btn' => 'required',
            'content_btn' => 'required',
            'image' => 'required|image',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'text_color.required' => 'Vui lòng nhập màu chữ cho nút.',
            'url_btn.required' => 'Vui lòng nhập URL cho nút.',
            'content_btn.required' => 'Vui lòng nhập nội dung cho nút.',
            'image.required' => 'Vui lòng chọn ảnh.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ];
    }
}
