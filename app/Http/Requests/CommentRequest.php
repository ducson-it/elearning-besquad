<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required',
            'tables' => 'required|array',
            'post_id' => 'required_if:tables.*,posts',
            'course_id' => 'required_if:tables.*,courses',
            'lesson_id' => 'required_if:tables.*,lessons',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Vui lòng nhập nội dung comment.',
            'tables.required' => 'Vui lòng chọn ít nhất một bảng để comment.',
            'post_id.required_if' => 'Vui lòng chọn bài viết để comment khi chọn bảng "Posts".',
            'course_id.required_if' => 'Vui lòng chọn khóa học để comment khi chọn bảng "Courses".',
            'lesson_id.required_if' => 'Vui lòng chọn bài học để comment khi chọn bảng "Lessons".',
        ];
    }
}
