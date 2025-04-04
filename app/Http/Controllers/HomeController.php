<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $logs = Log::where('user_id', Auth::user()->id)->take(10)->get();

        $userSubscription = Subscription::where('user_id', Auth::user()->id)->first();
        $userSubscription->used_capacity_ui = $this->convertMegabyte($userSubscription->used_capacity);
        $userSubscription->total_capacity_ui = $this->convertMegabyte($userSubscription->total_capacity);

        foreach ($logs as $row) {
            $row->username = User::find($row->user_id)->email;
        }

        return view('frontend.pages.home', compact('logs', 'userSubscription'));
    }

    
}
