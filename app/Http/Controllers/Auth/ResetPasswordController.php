<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function showResetPasswordForm($token)
    {
        return view('frontend.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
                'token' => 'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Định dạng email không hợp lệ.',
                'password.required' => 'Vui lòng nhập mật khẩu mới.',
                'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
                'token.required' => 'Vui lòng cung cấp mã xác nhận.',
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        // Xử lý trạng thái trả về của reset mật khẩu
        switch ($status) {
            case Password::PASSWORD_RESET:
                return redirect()->route('login')->with('status', 'Mật khẩu đã được đặt lại thành công. Vui lòng đăng nhập.');

            case Password::INVALID_TOKEN:
                return back()->withErrors(['token' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn. Vui lòng thử lại.']);

            case Password::INVALID_USER:
                return back()->withErrors(['email' => 'Không tìm thấy tài khoản với email này. Vui lòng kiểm tra lại.']);

            default:
                return back()->withErrors(['email' => 'Đã xảy ra lỗi không xác định. Vui lòng thử lại sau.']);
        }
    }
}
