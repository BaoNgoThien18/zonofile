<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('frontend.auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email'=>'required|exists:users,email',
        ], 
        ['email.required'=>"Vui lòng nhập email ",
            'email.exists'=>"Email này chưa được đăng kí"]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Email đã gửi thành công'])
            : back()->withErrors(['email' => 'Gửi Email thất bại']);
        
    }
}
