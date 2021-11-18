<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestUser extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'address' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống',
            'email.required' => ':attribute không được để trống',
            'email.unique' => ':attribute là duy nhất',
            'email.email' => ':attribute phải đúng định dạng kiểu email',
            'password.required' => ':attribute không được để trống',
            'password.same' => ':attribute phải giống password confirm',
            'password.min' => ':attribute không được nhỏ hơn 6 ký tự',
            'password_confirmation.required' => ':attribute không được để trống',
            'password_confirmation.min' => ':attribute không được nhỏ hơn 6 ký tự',
            'address.required' => ':attribute không được để trống',
            'phone.required' => ':attribute không được để trống',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên người dùng',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Confirm mật khẩu',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
        ];
    }
}