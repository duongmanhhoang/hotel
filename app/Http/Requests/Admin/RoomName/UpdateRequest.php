<?php

namespace App\Http\Requests\Admin\RoomName;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'max:191',
                'unique' => Rule::unique('room_names')->where('lang_id', session('locale'))->ignore($this->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vui lòng không nhập quá' . ' :max ' . 'ký tự',
            'name.unique' => 'Tên này đã được sử dụng',
        ];
    }
}
