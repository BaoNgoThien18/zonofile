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
        Schema::create('packages', function (Blueprint $table) {
            $table->id(); // id as primary key, auto-increment
            $table->string('name', 255); // name as varchar(255)
            $table->text('description'); // description as text
            $table->decimal('price', 19, 2); // price as decimal(19,2)
            $table->integer('capacity')->default(0);
            $table->integer('duration'); // duration as int(11)
            $table->integer('status'); // status as int(11)
            $table->timestamps(); // adds created_at and updated_at fields
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