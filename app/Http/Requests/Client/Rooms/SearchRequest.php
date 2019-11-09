<?php

namespace App\Http\Requests\Client\Rooms;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'location_id' => 'required',
            'adults' => 'required',
            'children' => 'required',
            'checkIn' => 'required|after:yesterday',
            'checkOut' => 'required|after:checkIn',
        ];
    }

    public function messages()
    {
        return [
            'location_id.required' => __('messages.validation.required'),
            'adults.required' => __('messages.validation.required'),
            'children.required' => __('messages.validation.required'),
            'checkIn.required' => __('messages.validation.required'),
            'checkOut.required' => __('messages.validation.required'),
            'checkIn.after' => __('messages.validation.checkInAfter'),
            'checkOut.after' => __('messages.validation.checkOutAfter'),
        ];
    }
}
