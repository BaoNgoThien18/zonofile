<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packages')->insert([
            [
                'id' => 1,
                'name' => 'Gói Mặc Định',
                'description' => '
                   
                        <li><strong>Miễn phí</strong> dành cho người dùng mới.</li>
                        <li>Dung lượng lưu trữ: 5GB.</li>
                        <li>Thời hạn sử dụng: 30 ngày.</li>
                    ',
                'price' => 0,
                'capacity' => 5120, 
                'duration' => 30, 
                'status' => 0, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Gói Cơ Bản',
                'description' => '
                        <li><strong>Phù hợp</strong> người dùng phổ thông.</li>
                        <li>Dung lượng lưu trữ: 50GB.</li>
                        <li>Thời hạn sử dụng: 30 ngày.</li>
                        <li>Chi phí hợp lý: 50.000 VNĐ.</li>
                    ',
                'price' => 50000,
                'capacity' => 51200,
                'duration' => 30,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Gói Cao Cấp',
                'description' => '
                        <li>Dung lượng lưu trữ: <strong>500GB</strong>.</li>
                        <li>Tốc độ tải xuống nhanh hơn.</li>
                        <li>Thời hạn sử dụng: 90 ngày.</li>
                        <li>Chi phí: 200.000 VNĐ.</li>
                    ',
                'price' => 200000,
                'capacity' => 512000,
                'duration' => 90,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Gói Doanh Nghiệp',
                'description' => '
                        <li>Dành cho doanh nghiệp.</li>
                        <li>Dung lượng lưu trữ: <strong>1500GB</strong>.</li>
                        <li>Thời hạn sử dụng: 1 năm.</li>
                        <li>Chi phí: 490.000 VNĐ.</li>
                    ',
                'price' => 490000,
                'capacity' => 1536000,
                'duration' => 365,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}