<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotifycationRequest extends FormRequest
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
            'content_notify' => 'required',
            'group_user' => Rule::requiredIf(function () {
                return $this->option === 'option2';
            }),
            'group_user.*' => 'exists:users,id',
            'priority' => 'required',
            'notification_type' => 'required',
            'expired' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'content_notify.required' => 'Vui lòng nhập nội dung thông báo.',
            'group_user.required' => 'Vui lòng chọn ít nhất một người dùng.',
            'group_user.array' => 'Dữ liệu người dùng không hợp lệ.',
            'group_user.*.exists' => 'Người dùng không hợp lệ.',
            'priority.required' => 'Vui lòng chọn mức ưu tiên.',
            'notification_type.required' => 'Vui lòng chọn loại thông báo.',
            'expired.required' => 'Vui lòng chọn ngày hết hạn.',
            'expired.date' => 'Ngày hết hạn không hợp lệ.',
        ];
    }
}
