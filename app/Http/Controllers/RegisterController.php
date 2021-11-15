<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\departments\DepartmentService;
use App\Http\Services\users\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $departmentService;
    protected $userService;

    public function __construct(DepartmentService $departmentService, UserService $userService)
    {
        $this->departmentService = $departmentService;
        $this->userService = $userService;
    }

    public function getRegister()
    {
        return view('register', [
            'departments' => $this->departmentService->getDepartment()
        ]);
    }

    public function postRegister(RegisterRequest $request)
    {
        $this->userService->register($request);

        return redirect()->route('getLogin');
    }

    public function showForgetPasswordForm()
    {
        return view('forgot_password');
    }

    public function submitForgetPasswordForm(ForgotPasswordRequest $request) 
    {
        $this->userService->sendMail($request);

        return back();
    }

    public function showResetPasswordForm($token) 
    { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $this->userService->resetPassword($request);

        return redirect('login');
    }
}
