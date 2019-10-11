<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:191',
            'phone' => 'nullable|numeric|digits:10',
            'address' => 'max:191',
            'password' => 'nullable|min:8|max:15|confirmed',
        ];
    }

    public function messages() {
        return [
            'full_name.required' => 'Vui lòng nhập họ và tên',
            'full_name.max' => 'Vui lòng không nhập quá 191 ký tự',
            'phone.digits' => 'Số điện thoại phải có 10 số',
            'phone.numeric' => 'Vui lòng chỉ nhập số',
            'address.max' => 'Vui lòng không nhập quá 191 ký tự',
            'password.min' => 'Mật khẩu ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu dài tối đa 15 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng',
        ];
    }
}
