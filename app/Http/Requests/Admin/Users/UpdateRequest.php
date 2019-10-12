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
            'phone' => 'nullable|numeric|digits_between:10,15',
            'address' => 'max:191',
        ];
    }

    public function messages() {
        return [
            'full_name.required' => 'Vui lòng nhập họ và tên',
            'full_name.max' => 'Vui lòng không nhập quá 191 ký tự',
            'phone.digits_between' => 'Số điện thoại tối thiếu là 10 số và tối đa là 15 số',
            'phone.numeric' => 'Vui lòng chỉ nhập số',
            'address.max' => 'Vui lòng không nhập quá 191 ký tự',
        ];
    }
}
