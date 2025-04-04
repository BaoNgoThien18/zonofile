<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Log;
use App\Models\Subscription;
use App\Models\Package;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login'); // Tạo view cho trang đăng nhập
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/'); // Chuyển hướng đến trang dashboard
        }

        return back()->with('error', 'Thông tin đăng nhập không chính xác.', );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Chuyển hướng về trang đăng nhập
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register'); // Tạo view cho trang đăng ký
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|min:3|max:50',
                'email' => 'required|string|email|min:5|max:100|unique:users',
                'password' => 'required|string|min:8',
            ],
            [
                'name.required' => 'Tên là trường bắt buộc.',
                'name.string' => 'Tên phải là một chuỗi ký tự.',
                'name.min' => 'Tên phải có ít nhất 3 ký tự.',
                'name.max' => 'Tên không được vượt quá 50 ký tự.',

                'email.required' => 'Email là trường bắt buộc.',
                'email.string' => 'Email phải là một chuỗi ký tự.',
                'email.email' => 'Email không đúng định dạng.',
                'email.min' => 'Email phải có ít nhất 5 ký tự.',
                'email.max' => 'Email không được vượt quá 100 ký tự.',
                'email.unique' => 'Email đã tồn tại trong hệ thống.',

                'password.required' => 'Mật khẩu là trường bắt buộc.',
                'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            ]
        );


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mã hóa mật khẩu
        ]);

        Log::create([
            'user_id' => $user->id,
            'ip' => $request->ip(),
            'device' => $request->header('User-Agent'),
            'action' => 'Đăng ký thành công',
        ]);

        $defaultPackage = Package::find(1);

        // Thêm gói mặc định cho user
        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->package_id = 1;
        $subscription->total_capacity += $defaultPackage->capacity;
        $subscription->used_capacity = 0;
        $subscription->start_date = now();
        $subscription->end_date = now()->addDays($defaultPackage->duration);
        $subscription->status = '1';
        $subscription->save();

        Auth::login($user); // Đăng nhập người dùng mới
        return redirect()->intended('/');
    }
}