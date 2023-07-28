<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
        $unit = $this->input('unit');
        $rules =  [
            //
            'name' => 'required',
            'code' => 'required',
            'expired' => 'required',
            'unit' => 'required',

        ];
        // Nếu 'unit' là 'VND', thêm validation cho 'vnd_value'
        if ($unit === 'VND') {
            $rules['vnd_value'] = 'required|min:0';
        }

        // Nếu 'unit' là 'Percent', thêm validation cho 'percentage_value'
        if ($unit === 'Percent') {
            $rules['percentage_value'] = 'required|min:0|max:100';
        }
        if ($this->getMethod() === 'POST') {
            $rules['code'] = 'unique:vouchers,code';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Đây là trường bắt buộc không được để trống.',
            'code.required' => 'Đây là trường bắt buộc không được để trống.',
            'code.unique'=>'Mã code đặt đã bị trùng với voucher khác, vui lòng đặt lại mã.',
            'expired.required' => 'Đây là trường bắt buộc không được để trống.',
            'unit.required' => 'Đây là trường bắt buộc không được để trống.',
            'vnd_value.required'=>'Đây là trường bắt buộc không được để trống.',
            'vnd_value.min'=>'Không được nhập số âm',
            'percentage_value.required'=>'Đây là trường bắt buộc không được để trống.',
            'percentage_value.min'=>'Không được nhập số âm',
            'percentage_value.max'=>'Không được nhập quá 100'
        ];
    }
}
