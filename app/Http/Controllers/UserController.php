<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use DB;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all();

        $totalUsers = User::count();
        $totalUserActives = User::where('banned', 0)->count();
        $totalUserBanneds = User::where('banned', 1)->count();
        $userStars = DB::table('users')
            ->join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
            ->where('subscriptions.package_id', 5)
            ->limit(20)
            ->count();

        foreach ($users as $row) {

            $userSubscription = Subscription::where('user_id', $row->id)->first();

            $row->totalPayment = Payment::where('user_id', $row->id)->sum('amount');
            $row->subscription = $userSubscription;
            $row->package = Package::find($userSubscription->package_id);
        }

        return view('backend.pages.users.index', compact('users', 'totalUsers', 'totalUserActives', 'totalUserBanneds', 'userStars'));
    }
    /**
     * Profile Client
     */
    public function profileClient()
    {
        $user = Auth::user();
        $subscription = Subscription::where('user_id', $user->id)->first();
        $payments = Payment::where('user_id', $user->id)->get();
        $logs = \App\models\Log::where('user_id', Auth::user()->id)->get();

        $userSubscription = Subscription::where('user_id', Auth::user()->id)->first();
        $userSubscription->used_capacity_ui = $this->convertMegabyte($userSubscription->used_capacity);
        $userSubscription->total_capacity_ui = $this->convertMegabyte($userSubscription->total_capacity);

        foreach ($logs as $row) {
            $row->username = User::find($row->user_id)->email;
        }
        return view('frontend.profile.profile', compact('user', 'payments', 'subscription', 'logs'));
    }
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            $avatarPath = $user->avatar;

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $avatar = $request->file('avatar');
                $avatarName = $user->id . '_avatar.' . $avatar->getClientOriginalExtension();

                $avatarPath = 'frontend/images/avatars/' . $avatarName;

                $moved = $avatar->move(public_path('frontend/images/avatars'), $avatarName);

                if (!$moved) {
                    Log::error('Không thể lưu avatar', ['user_id' => $user->id]);
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Không thể lưu avatar, vui lòng thử lại.',
                    ], 500);
                }
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            ]);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'avatar' => $avatarPath, // Cập nhật avatar mới nếu có
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Thông tin người dùng đã được cập nhật thành công.',
                'user' => $user // Trả về dữ liệu người dùng đã cập nhật
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại.',
                'error' => $e->getMessage(), // Ghi lại chi tiết lỗi
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.Users.AddUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();


        $userSubscription = Subscription::where('user_id', $user->id)->first();

        $user->totalPayment = Payment::where('user_id', $user->id)->sum('amount');
        $user->subscription = $userSubscription;
        $user->package = Package::find($userSubscription->package_id);

        return view('backend.pages.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'rule' => 'required|in:user,admin',
            'banned' => 'required|boolean',
            'name' => 'required'
        ]);

        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Người dùng không tồn tại.');
        }

        // Cập nhật dữ liệu
        $user->rule = $validatedData['rule'];
        $user->banned = $validatedData['banned'];
        $user->name = $validatedData['name'];

        if ($user->save()) {
            // Cập nhật thành công
            return redirect()->back()->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
        }

        // Trường hợp lưu thất bại
        return redirect()->back()->with('error', 'Không thể cập nhật thông tin người dùng.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}