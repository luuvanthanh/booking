<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'date' => 'required',
            'from_to' => 'required',
            'room_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => ':attribute không được để trống',
            'from_to.required' => ':attribute không được để trống',
            'room_id.required' => ':attribute không được để trống',
        ];
    }

    public function attributes()
    {
        return [
            'date' => 'Ngày đặt',
            'from_to' => 'Thời gian đặt',
            'room_id' => 'Phòng họp',
        ];
    }
}
