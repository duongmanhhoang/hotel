<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;

class BillPostRequest extends FormRequest
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
            'title' => 'required',
            'money' => 'required|numeric',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('messages.required_field'),
            'money.required' => __('messages.required_field'),
            'body.required' => __('messages.required_field'),
            'money.numeric' => 'Phải là số',
        ];
    }
}
