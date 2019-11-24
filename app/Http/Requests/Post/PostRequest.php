<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'image' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => __('messages.required_field'),
            'category_id.required' => __('messages.required_field'),
            'title.required' => __('messages.required_field'),
            'description.required' => __('messages.required_field'),
            'body.required' => __('messages.required_field'),
        ];
    }
}
