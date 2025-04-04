<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Payment;
use App\Models\User;
use App\Models\Log;


class AdminController extends Controller
{
    public function showThemesPage()
    {
        return view('backend.pages.themes');
    }

    public function showDashboardPage()
    {
        $currentDate = Carbon::today(); // Ngày hôm nay
        $startOfWeek = Carbon::now()->startOfWeek(); // Ngày bắt đầu tuần
        $endOfWeek = Carbon::now()->endOfWeek(); // Ngày kết thúc tuần
        $currentMonth = Carbon::now()->month; // Tháng hiện tại
        $currentYear = Carbon::now()->year; // Năm hiện tại
    
        // Thống kê hôm nay
        $todayRevenue = Payment::whereDate('created_at', $currentDate)->sum('amount');
        $todayNewUsers = User::whereDate('created_at', $currentDate)->count();
        $todayNewFiles = Document::whereDate('created_at', $currentDate)->count();
    
        // Thống kê tuần
        $weeklyRevenue = Payment::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('amount');
        $weeklyNewUsers = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $weeklyNewFiles = Document::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    
        // Thống kê tháng hiện tại
        $monthlyRevenue = Payment::whereMonth('created_at', $currentMonth)
                                  ->whereYear('created_at', $currentYear)
                                  ->sum('amount');
        $monthlyNewUsers = User::whereMonth('created_at', $currentMonth)
                                ->whereYear('created_at', $currentYear)
                                ->count();
        $monthlyNewFiles = Document::whereMonth('created_at', $currentMonth)
                                ->whereYear('created_at', $currentYear)
                                ->count();
    
        // Các thống kê tổng
        $totalRevenue = Payment::sum('amount');
        $totalUsers = User::count();
        $totalFiles = Document::count();
        $totalUsedCapacity = Subscription::sum('used_capacity');

        $historyPayments = Payment::limit(500)->get();

        $historyLogs = Log::limit(500)->get();


        foreach ($historyPayments as $row) {
            $row->username = User::find($row->user_id)->email;
        }

        foreach ($historyLogs as $row) {
            $row->username = User::find($row->user_id)->email;
        }

        return view('backend.pages.dashboard', compact(
            'historyPayments', 
            'historyLogs', 
            'todayRevenue',
            'todayNewUsers',
            'todayNewFiles',
            'weeklyRevenue',
            'weeklyNewUsers',
            'weeklyNewFiles',
            'monthlyRevenue',
            'monthlyNewUsers',
            'monthlyNewFiles',
            'totalRevenue',
            'totalUsers',
            'totalFiles',
            'totalUsedCapacity'
        ));


    }
    public function showTopupsPage()
    {

        $historyPayments = Payment::limit(500)->get();

        foreach ($historyPayments as $row) {
            $row->username = User::find($row->user_id)->email;
        }

        return view('backend.pages.topups', compact('historyPayments'));
    }
}