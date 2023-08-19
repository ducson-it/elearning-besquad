<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'phone' => 'min:10',
            'role_id' => 'required',
            'active' => 'required',
        ];

        // Add conditional rules for email and password fields
        if ($this->has('email')) {
            $rules['email'] = 'required|email|unique:users,email';
        }

        if ($this->has('password')) {
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'required|same:password';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên là trường bắt buộc.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'email.unique'=> 'Email đã tồn tại, hãy nhập email khác ',
            'password.required' => 'Mật khẩu là trường bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'confirm_password.required' => 'Xác nhận mật khẩu là trường bắt buộc.',
            'confirm_password.same' => 'Xác nhận mật khẩu phải khớp với mật khẩu.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 so',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'role_id.required' => 'Loại tài khoản là trường bắt buộc.',
            'active.required' => 'Trạng thái là trường bắt buộc.',
        ];
    }

}
