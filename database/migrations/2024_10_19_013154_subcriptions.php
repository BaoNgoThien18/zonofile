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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id(); // id as primary key, auto-increment
            $table->unsignedBigInteger('package_id')->index(); // package_id as indexed int(11)
            $table->unsignedBigInteger('user_id')->index(); // user_id as indexed int(11)
            $table->date('start_date'); // start_date as date
            $table->date('end_date'); // end_date as date
            $table->integer('status'); // status as int(11)
            $table->integer('total_capacity')->default(5120); // status as int(11)
            $table->integer('used_capacity')->default(0);
            
            $table->timestamps(); // adds created_at and updated_at fields
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('user_id')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};