<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6|max:15',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.validation.required'),
            'email.email' => __('messages.validation.email'),
            'password.required' => __('messages.validation.required'),
            'password.min' => __('messages.validation.min', ['number' => ':min']),
            'password.max' => __('messages.validation.max', ['number' => ':max']),
        ];
    }
}
