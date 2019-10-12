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
            'name' => [
                'required',
                'max:191',
                Rule::unique('room_details')->where('lang_id', $this->lang_id)
            ],
            'price' => 'required|numeric|min:1',
            'sale_price' => 'nullable|lt:price|numeric',
            'short_description' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống',
            'name.max' => 'Tên không được vượt quá' . ' :max ' . 'ký tự',
            'name.unique' => 'Tên này đã được sử dụng',
            'price.required' => 'Vui lòng không bỏ trống',
            'price.numeric' => 'Vui lòng chỉ nhập số',
            'price.min' => 'Vui lòng không nhập nhỏ hơn ' . ' :min ',
            'short_description.required' => 'Vui lòng không bỏ trống',
            'sale_price.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'description.required' => 'Vui lòng không bỏ trống',
        ];
    }
}
