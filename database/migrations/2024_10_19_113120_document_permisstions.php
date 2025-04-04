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
        Schema::create('document_permission', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('document_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('rule');

            $table->timestamps();


            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
