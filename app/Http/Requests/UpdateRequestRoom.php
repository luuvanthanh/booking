<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestRoom extends FormRequest
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
            'roomNumber' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'roomNumber.required' => ':attribute không được để trống',
            'roomNumber.numeric' => ':attribute phải là kiểu số',
        ];
    }

    public function attributes()
    {
        return [
            'roomNumber' => 'Số phòng',
        ];
    }
}
