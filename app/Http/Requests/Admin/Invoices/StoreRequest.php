<?php

namespace App\Http\Requests\Admin\Invoices;

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
            'check_in_date' => 'required|after:yesterday',
            'check_out_date' => 'required|after:check_in_date',
            'room_id' => 'required',
            'room_number' => 'required',
            'extra' => 'nullable|numeric',
            'customer_name' => 'required|max:191',
            'customer_email' => 'nullable|email|max:191',
            'customer_phone' => 'required|numeric|digits_between:9,15',
            'customer_address' => 'nullable|max:191',
        ];
    }

    public function messages()
    {
        return [
            'check_in_date.required' => 'Vui lòng không bỏ trống',
            'check_in_date.after' => 'Vui lòng chọn từ ngày hôm nay',
            'check_out_date.required' => 'Vui lòng không bỏ trống',
            'check_out_date.after' => 'Vui lòng chọn sau ngày đến',
            'room_id.required' => 'Vui lòng không bỏ trống',
            'room_number.required' => 'Vui lòng không bỏ trống',
            'extra.numeric' => 'Vui lòng chỉ nhập số',
            'customer_name.required' => 'Vui lòng không bỏ trống',
            'customer_name.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'customer_email.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'customer_phone.required' => 'Vui lòng không bỏ trống',
            'customer_phone.numeric' => 'Vui lòng chỉ nhập số',
            'customer_phone.digits_between' => 'Vui lòng chỉ nhập trong khoảng từ 9 đến 15 số',
            'customer_address.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
        ];
    }
}
