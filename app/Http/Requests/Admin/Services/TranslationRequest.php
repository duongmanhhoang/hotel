<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TranslationRequest extends FormRequest
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
                'max:191',
                Rule::unique('services')->where('lang_id', $this->lang_id),
            ],
            'price' => 'required|numeric|min:0|max:999999999',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống',
            'name.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'name.unique' => 'Tên này đã được sử dụng',
            'price.required' => 'Vui lòng không bỏ trống',
            'price.numeric' => 'Vui lòng chỉ nhập số',
            'price.min' => 'Vui lòng không nhập nhỏ hơn ' . ' :min ',
            'price.max' =>'Vui lòng không nhập lớn hơn ' . ' :max',
        ];
    }
}
