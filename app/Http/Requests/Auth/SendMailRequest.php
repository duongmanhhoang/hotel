<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendMailRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::exists('users')->where('is_active', User::ACTIVE),
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.validation.required'),
            'email.email' => __('messages.validation.email'),
            'email.exists' => __('messages.validation.email_exists'),
        ];
    }
}
