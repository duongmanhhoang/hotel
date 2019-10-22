<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

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
            'logo' => 'nullable|mimes:jpg,png,jpeg|max:2000',
            'logo_footer' => 'nullable|mimes:jpg,png,jpeg|max:2000',
            'facebook' => 'required|max:191',
            'twitter' => 'required|max:191',
            'instagram' => 'required|max:191',
            'linkedin' => 'required|max:191',
            'tripadvisor' => 'required|max:191',
            'youtube' => 'required|max:191',
            'google_plus' => 'required|max:191',
            'address' => 'required|max:191',
            'phone' => 'required|numeric|digits_between:10,15',
        ];
    }
    public function messages()
    {
        return [
            'logo.mimes' => 'Vui lòng chỉ chọn ảnh định dạng jpg, png, jpeg',
            'logo.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'logo_footer.mimes' => 'Vui lòng chỉ chọn ảnh định dạng jpg, png, jpeg',
            'logo_footer.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'facebook.required' => 'Vui lòng không bỏ trống',
            'twitter.required' => 'Vui lòng không bỏ trống',
            'instagram.required' => 'Vui lòng không bỏ trống',
            'linkedin.required' => 'Vui lòng không bỏ trống',
            'tripadvisor.required' => 'Vui lòng không bỏ trống',
            'youtube.required' => 'Vui lòng không bỏ trống',
            'google_plus.required' => 'Vui lòng không bỏ trống',
            'address.required' => 'Vui lòng không bỏ trống',
            'phone.required' => 'Vui lòng không bỏ trống',
            'phone.digits_between' => 'Số điện thoại tối thiếu là 10 số và tối đa là 15 số',
            'phone.numeric' => 'Vui lòng chỉ nhập số',

            'facebook.max' => 'Vui lòng không nhập quá 191 ký tự',
            'twitter.max' => 'Vui lòng không nhập quá 191 ký tự',
            'instagram.max' => 'Vui lòng không nhập quá 191 ký tự',
            'linkedin.max' => 'Vui lòng không nhập quá 191 ký tự',
            'tripadvisor.max' => 'Vui lòng không nhập quá 191 ký tự',
            'youtube.max' => 'Vui lòng không nhập quá 191 ký tự',
            'google_plus.max' => 'Vui lòng không nhập quá 191 ký tự',
            'address.max' => 'Vui lòng không nhập quá 191 ký tự',
        ];
    }
}
