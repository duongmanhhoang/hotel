<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|max:191|email|unique:users',
            'password' => 'required|min:8|max:15',
            'role_id' => 'required',
            'phone' => 'required|numeric|digits:10',
            'address' => 'max:191',
        ];
    }

    public function messages() {
        return [
            'full_name.required' => 'Vui lòng nhập họ và tên',
            'full_name.max' => 'Vui lòng không nhập quá 191 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Vui lòng không nhập quá 191 ký tự',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu dài tối đa 15 ký tự',
            'role_id.required' => 'Vui lòng chọn vai trò cho tài khoản',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits' => 'Số điện thoại phải có 10 số',
            'phone.numeric' => 'Vui lòng chỉ nhập số',
            'address.max' => 'Vui lòng không nhập quá 191 ký tự',
        ];
    }
}
