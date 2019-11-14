<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required|min:6|max:15|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => __('messages.validation.required'),
            'password.min' => __('messages.validation.min', ['number' => ':min']),
            'password.max' => __('messages.validation.max', ['number' => ':max']),
            'password.confirmed' => __('messages.validation.password_confirm'),
            'password_confirmation.required' => __('messages.required'),
        ];
    }
}
