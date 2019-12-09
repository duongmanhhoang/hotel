<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email, ' . $this->id,
            'password' => 'required|confirmed|min:6',
            'full_name' => 'required',
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => __('messages.required_field'),
            'full_name.required' => __('messages.required_field'),
            'email.required' => __('messages.required_field'),
            'email.email' => __('messages.user.email_format'),
            'email.unique' => __('messages.user.unique'),
            'password.confirmed' => __('messages.user.confirmed'),
            'phone.required' => __('messages.required_field'),
            'phone.numeric' => __('messages.numeric_required'),
        ];
    }
}
