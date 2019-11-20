<?php

namespace App\Http\Requests\Admin\Locations;

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
            'name' => [
                'required',
                'max:191',
                Rule::unique('locations')->where('lang_id', config('common.languages.default'))
            ],
            'address' => [
                'required',
                'max:191',
                Rule::unique('locations')->where('lang_id', config('common.languages.default'))
            ],
            'phone' => [
                'required',
                'numeric',
                Rule::unique('locations')->where('lang_id', config('common.languages.default')),
                'digits_between:1,15',
            ],
            'province_id' => 'required',
            'email' => 'required|email|max:191'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng không bỏ trống',
            'name.max' => 'Vui lòng không nhập quá 191 ký tự',
            'address.required' => 'Vui lòng không bỏ trống',
            'address.max' => 'Vui lòng không nhập quá 191 ký tự',
            'phone.required' => 'Vui lòng không bỏ trống',
            'phone.numeric' => 'Vui lòng chỉ nhậo số',
            'province_id.required' => 'Vui lòng không bỏ trống',
            'email.required' => 'Vui lòng không bỏ trống',
            'email.max' => 'Vui lòng không nhập quá 191 ký tự',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'name.unique' => 'Tên này đã được sử dụng',
            'phone.unique' => 'Số điện thoại này đã được sử dụng',
            'address.unique' => 'Địa chỉ này đã được sử dụng',
            'phone.digits_between' => 'Vui lòng chỉ nhập trong khoảng từ :min tới :max số'
        ];
    }
}
