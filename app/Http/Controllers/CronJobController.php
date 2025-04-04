<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronJobController extends Controller
{
    public function removeFile() {
        $files = Document::where('is_deleted', 1)
        ->where('updated_at', '>=', Carbon::now()->subDays(30))->delete();
        die('Xóa file thành công!');
    }
}
