<?php

namespace App\Http\Requests\Admin\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'max:20',
                Rule::unique('roles')->ignore($this->id),
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống',
            'name.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'name.unique' => 'Tên này đã được sử dụng',
        ];
    }
}