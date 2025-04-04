<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {

            $table->id(); 
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('folder_id')->index()->nullable();
            $table->string('title', 255);
            $table->string('path', 255);
            $table->string('type', 255);
            $table->string('size', 255);
            $table->string('shared_id', 255);
            $table->integer('is_deleted')->default(0);
            $table->integer('count_downloads')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('folder_id')->references('id')->on('folders');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};