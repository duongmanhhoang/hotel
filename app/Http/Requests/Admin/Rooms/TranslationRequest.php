<?php

namespace App\Http\Requests\Admin\Rooms;

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
            'price' => 'required|numeric|min:0|max:999999999',
            'sale_price' => 'nullable|lt:price|numeric',
            'short_description' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Vui lòng không bỏ trống',
            'price.numeric' => 'Vui lòng chỉ nhập số',
            'price.min' => 'Vui lòng không nhập nhỏ hơn ' . ' :min ',
            'price.max' => 'Vui lòng không nhập lớn hơn ' . ' :max ',
            'short_description.required' => 'Vui lòng không bỏ trống',
            'sale_price.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'description.required' => 'Vui lòng không bỏ trống',
        ];
    }
}
