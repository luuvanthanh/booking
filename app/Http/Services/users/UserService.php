<?php

namespace App\Http\Services\users;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function sendMail($request)
    {
        $token = Str::random(64);
        try {
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
            ]);
    
            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            session()->flash('success', 'Chúng tôi đã gửi qua e-mail liên kết đặt lại mật khẩu của bạn!');
        } catch (\Exception $err) {
            session()->flash('erorr', 'Gửi mail thất bại');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function resetPassword($request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);
        
            $updatePassword = DB::table('password_resets')
                                ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                                ])
                                ->first();
        
            if(!$updatePassword){
                return back()->withInput()->with('error', 'Invalid token!');
            }
        
            $user = User::where('email', $request->email)
                        ->update(['password' => bcrypt($request->password)]);
        
            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            session()->flash('success', 'Mật khẩu của bạn đã được thay đổi!');
        } catch (\Exception $err) {
            session()->flash('erorr', 'Thay đổi mật khẩu thất bại');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
}