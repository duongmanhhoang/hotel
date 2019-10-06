<?php

namespace App\Http\Requests\Admin\Languages;

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
            'flag' => 'nullable|mimes:jpg,png,jpeg|max:2000',
            'name' => [
                'required',
                'max:191',
                Rule::unique('languages')->ignore($this->id),
            ],
            'short' => [
                'required',
                'max:191',
                Rule::unique('languages')->ignore($this->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'flag.required' => 'Vui lòng chọn ảnh',
            'flag.mimes' => 'Vui lòng chỉ chọn ảnh định dạng jpg, png, jpeg',
            'flag.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'name.required' => 'Vui lòng không bỏ trống',
            'name.unique' => 'Tên này đã được sử dụng',
            'name.max' => 'Vui lòng không nhập quá 191 ký tự',
            'short.required' => 'Vui lòng không bỏ trống',
            'short.unique' => 'Tên rút gọn này đã được sử dụng',
            'short.max' => 'Vui lòng không nhập quá 191 ký tự',
        ];
    }
}
