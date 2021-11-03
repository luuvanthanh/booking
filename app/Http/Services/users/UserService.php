<?php

namespace App\Http\Services\users;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function create($request)
    {
        $request->except('_token', 'password_confirmation');
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'isAdmin' => $request->isAdmin,
            'department_id' => $request->department_id,
        ];
        try {
            User::create($data);

            session()->flash('success', 'Đăng ký thành công');
        } catch (\Exception $err) {

            session()->flash('erorr', 'Đăng ký thất bại');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }
}