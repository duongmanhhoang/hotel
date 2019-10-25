<?php

namespace App\Http\Requests\Admin\Rooms;

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
            'image' => 'required|mimes:jpg,jpeg,png|max:2000',
            'room_name_id' => [
                'required',
                'max:191',
                Rule::unique('rooms'),
            ],
            'room_number.*' => 'required',
            'price' => 'required|numeric|min:1000',
            'sale_price' => 'nullable|lt:price|numeric',
            'sale_start_at' => 'nullable|after:yesterday',
            'sale_end_at' => 'nullable|after_or_equal:sale_start_at',
            'short_description' => 'required',
            'description' => 'required',
            'adults' => 'required|numeric|min:1|max:10',
            'children' => 'required|numeric|min:1|max:10',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Vui lòng không bỏ trống',
            'image.mimes' => 'Vui lòng chỉ chọn ảnh jpg, jpeg, png',
            'image.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'room_name_id.required' => 'Vui lòng không bỏ trống',
            'room_name_id.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'room_name_id.unique' => 'Tên này đã được sử dụng',
            'room_number.*.required' => 'Vui lòng không bỏ trống',
            'price.required' => 'Vui lòng không bỏ trống',
            'price.numeric' => 'Vui lòng chỉ nhập số',
            'price.min' => 'Vui lòng không nhập nhỏ hơn ' . ' :min ' . ' vnđ',
            'sale_price.numeric' => 'Vui lòng chỉ nhập số',
            'sale_price.lt' => 'Giá khuyến mãi không được lớn hơn giá gốc',
            'sale_start_at' => 'Ngày bắt đầu không thể là ngày đã qua',
            'sale_end_at.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu',
            'short_description.required' => 'Vui lòng không bỏ trống',
            'description.required' => 'Vui lòng không bỏ trống',
            'adults.required' => 'Vui lòng không bỏ trống',
            'adults.numeric' => 'Vui lòng chỉ nhập số',
            'adults.min' =>'Vui lòng không nhập nhỏ hơn ' . ' :min',
            'adults.max' =>'Vui lòng không nhập lớn hơn ' . ' :max',
            'children.required' => 'Vui lòng không bỏ trống',
            'children.numeric' => 'Vui lòng chỉ nhập số',
            'children.min' =>'Vui lòng không nhập nhỏ hơn ' . ' :min',
            'children.max' =>'Vui lòng không nhập lớn hơn ' . ' :max',
        ];
    }
}
