<?php

namespace App\Http\Requests\Client\Booking;

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
            'customer_name' => 'required|max:191',
            'customer_phone' => 'required|numeric',
            'customer_email' => 'nullable|email|max:191',
            'customer_address' => 'nullable|max:191',
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => __('messages.validation.required'),
            'customer_phone.required' => __('messages.validation.required'),
            'customer_phone.numeric' => __('messages.validation.numeric'),
            'customer_name.max' => __('messages.validation.max', ['number' => ':max']),
            'customer_email.max' => __('messages.validation.max', ['number' => ':max']),
            'customer_email.email' => __('messages.validation.email'),
            'customer_address.max' => __('messages.validation.max', ['number' => ':max']),

        ];
    }
}
