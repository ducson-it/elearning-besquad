<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required',
            'title'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Nội dung phản hồi là bắt buộc.',
            'title.required' => 'Tiêu đề là bắt buộc.',
        ];
    }
}
