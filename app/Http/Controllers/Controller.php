<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    public function checkLogin() {

        if (!Auth::check()) {
            die (response()->json(['status' => 'error', 'msg' => 'Vui lòng đăng nhập'], 400));
        }
    }

    /**
     * Chuyển đổi kích thước từ KB sang MB hoặc GB tùy thuộc vào giá trị.
     *
     * @param int $bytes Dung lượng cần chuyển đổi (tính bằng KB).
     * @return string Dung lượng sau khi chuyển đổi (có thể là MB hoặc GB).
     */
    function convertBytes($bytes) {

        if ($bytes < 1000) return $bytes . ' Byte';


        $kb = round(($bytes / 1024), 2); // Chia cho 1024*1024 để ra MB
        if ($kb < 1000) return $kb .  ' KB';;

        // Chuyển đổi từ B sang MB
        $mb = $bytes / (1024 * 1024); // Chia cho 1024*1024 để ra MB
        
        // Nếu giá trị lớn hơn 1000 MB, chuyển sang GB
        if ($mb >= 1000) {
            $gb = $mb / 1024; // Chia cho 1024 để ra GB
            return round($gb, 2) . ' GB';
        }
        
        // Nếu không lớn hơn 1000 MB, trả về MB
        return round($mb, 2) . ' MB';
    }

    function convertMegabyte($mb) {
      
        if ($mb >= 1000) {
            $gb = $mb / 1024; // Chia cho 1024 để ra GB
            return round($gb, 2) . ' GB';
        }
        
        // Nếu không lớn hơn 1000 MB, trả về MB
        return round($mb, 2) . ' MB';
    }

    function getFileExtension($input) {
        // Kiểm tra nếu đầu vào là tên file và có dấu chấm
        if (strpos($input, '.') !== false) {
            // Tách đuôi file từ tên file
            $fileExtension = pathinfo($input, PATHINFO_EXTENSION);
            return strtolower($fileExtension); // Chuyển đổi thành chữ thường để so sánh dễ dàng
        }
    
        // Nếu đầu vào không có dấu chấm, có thể là phần mở rộng
        return strtolower($input);
    }
    

    function getIconFile($fileEx) {
        $fileEx = $this->getFileExtension($fileEx);
    
        // Icon cho các định dạng file phổ biến
        if ($fileEx == 'zip')
            return '<i class="f-22 fa fa-file-archive-o font-primary"></i>';
        if ($fileEx == 'deb')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/9812/9812104.png" alt="">';
        if ($fileEx == 'docx')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/9496/9496487.png" alt="">';
        if ($fileEx == 'mp4')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/2306/2306142.png" alt="">';
        if ($fileEx == 'run')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/55/55240.png" alt="">';
        if ($fileEx == 'xlsx')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/732/732190.png" alt="">';  // Excel icon
        if ($fileEx == 'pptx')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/732/732221.png" alt="">';  // PowerPoint icon
        if ($fileEx == 'txt')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/1828/1828775.png" alt="">';  // Text file icon
        if ($fileEx == 'jpg' || $fileEx == 'jpeg' || $fileEx == 'png' || $fileEx == 'gif')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/8344/8344913.png" alt="">';  // Image icon
        if ($fileEx == 'csv')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/732/732190.png" alt="">';  // CSV file icon
        if ($fileEx == 'pdf')
            return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/337/337946.png" alt="">';
        // Mặc định là icon cho loại file không xác định
        return '<img width="36px" src="https://cdn-icons-png.flaticon.com/128/342/342348.png" alt="">';
    }

    function getIconRuleFile($rule) {

        // Icon cho các định dạng file phổ biến
        if ($rule == 'download')
            return '<i style="width: 20px" data-feather="download"></i>';

        if ($rule == 'download')
            return '<i style="width: 20px" data-feather="eye"></i>';

        // Mặc định là icon cho loại file không xác định
        return '<i style="width: 20px" data-feather="user"></i>';
    }
    




}
