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
        Schema::create('logs', function (Blueprint $table) {
            $table->id(); // id as primary key, auto-increment
            $table->unsignedBigInteger('user_id'); // user_id as int(11)
            $table->string('ip', 255); // ip as varchar(255)
            $table->string('device', 255); // device as varchar(255)
            $table->text('action'); // action as text
            $table->timestamps(); // adds created_at and updated_at fields
            
            $table->foreign('user_id')->references('id')->on('users');
        });


    }

    public function down(): void
    {
        //
    }
};
