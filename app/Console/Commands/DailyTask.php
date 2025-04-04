<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyTask extends Command
{
    protected $signature = 'task:daily';
    protected $description = 'Perform daily task';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Logic thực hiện hàng ngày
        \Log::info('Daily task has been executed successfully.');
        // Thêm logic thực hiện của bạn ở đây
    }
}
