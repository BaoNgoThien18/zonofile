<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('name'); // Tạo trường name
            $table->string('avatar')->nullable(); // Tạo trường avatar
            $table->string('email')->unique(); // Tạo trường email
            $table->string('password'); // Tạo trường password
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('rule')->default('user'); // Tạo trường rule với giá trị mặc định
            $table->integer('banned')->default(0);
            $table->string('rank')->nullable(); // Tạo trường rank
            // $table->decimal('money', 19, 2)->default(0.00); // Tạo trường money với giá trị mặc định
            // $table->decimal('total_money', 19, 2)->default(0.00); // Tạo trường total_money với giá trị mặc định

            $table->string('google_id')->nullable()->unique();


            $table->timestamps(); // Tạo các trường created_at và updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};