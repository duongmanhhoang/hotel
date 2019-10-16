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
            'facebook' => 'required|max:191',
            'twitter' => 'required|max:191',
            'instagram' => 'required|max:191',
            'linkedin' => 'required|max:191',
            'tripadvisor' => 'required|max:191',
        ];
    }
    public function messages()
    {
        return [
            'logo.mimes' => 'Vui lòng chỉ chọn ảnh định dạng jpg, png, jpeg',
            'logo.max' => 'Vui lòng không chọn ảnh quá 2MB',
            'facebook.required' => 'Vui lòng không bỏ trống',
            'twitter.required' => 'Vui lòng không bỏ trống',
            'instagram.required' => 'Vui lòng không bỏ trống',
            'linkedin.required' => 'Vui lòng không bỏ trống',
            'tripadvisor.required' => 'Vui lòng không bỏ trống',
            'facebook.max' => 'Vui lòng không nhập quá 191 ký tự',
            'twitter.max' => 'Vui lòng không nhập quá 191 ký tự',
            'instagram.max' => 'Vui lòng không nhập quá 191 ký tự',
            'linkedin.max' => 'Vui lòng không nhập quá 191 ký tự',
            'tripadvisor.max' => 'Vui lòng không nhập quá 191 ký tự',
        ];
    }
}
