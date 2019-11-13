<?php

namespace App\Http\Requests\Admin\Properties;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'image' => 'required|mimes:jpg,png,jpeg|max:2000',
            'name' => [
                'required',
                'max:191',
                Rule::unique('properties')->where('lang_parent_id', 0),
            ],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Vui lòng chọn ảnh',
            'image.mimes' => 'Vui lòng chỉ chọn ảnh định dạng jpg, png, jpeg',
            'image.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'name.unique' => 'Tên này đã được sử dụng',
        ];
    }
}
