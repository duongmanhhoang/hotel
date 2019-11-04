<?php

namespace App\Http\Requests\Admin\Services;

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
                Rule::unique('services')->where('lang_parent_id', 0),
            ],
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Vui lòng chọn ảnh',
            'image.mimes' => 'Vui lòng chỉ chọn ảnh định dạng jpg, png, jpeg',
            'image.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'name.required' => 'Vui lòng không bỏ trống',
            'name.unique' => 'Tên này đã được sử dụng',
            'name.max' => 'Vui lòng không nhập quá 191 ký tự',
            'price.required' => 'Vui lòng không bỏ trống',
            'price.numeric' => 'Vui lòng chỉ nhập số',
        ];
    }
}
