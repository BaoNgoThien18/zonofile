<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helpers/helpers.php');

         // Chia sẻ dữ liệu Setting với tất cả các view
        View::composer('*', function ($view) {
            $settings = Setting::all()->keyBy('name'); // Lấy settings và sắp xếp theo 'name'
            $view->with('settings', $settings);
        });
    }
}
