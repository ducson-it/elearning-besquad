<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=>':email không được để trống',
            'min'=>':phone tối thiểu :min ký tự'
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Email người dùng',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại'
        ];
    }
}
