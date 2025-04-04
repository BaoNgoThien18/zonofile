<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // Chuyển hướng đến Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Tìm hoặc tạo người dùng
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('123456dummy') // Dummy password
                ]
            );

            Auth::login($user);

    
            $defaultPackage = Package::find(1);
    
            // Thêm gói mặc định cho user
            $subscription = new Subscription();
            $subscription->user_id = $user->id;
            $subscription->package_id = $defaultPackage->id;
            $subscription->total_capacity += $defaultPackage->capacity;
            $subscription->used_capacity = 0;
            $subscription->start_date = now();
            $subscription->end_date = now()->addDays($defaultPackage->duration); 
            $subscription->status = '1';
            $subscription->save();
    
            Auth::login($user); // Đăng nhập người dùng mới
            return redirect()->intended('/');


        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập thất bại!');
        }
    }
}
