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
        Schema::create('public_data', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('user_id')->nullable();
            $table->string('title');
            $table->string('desc');
            $table->string('status');
            $table->string('due_date');
            $table->string('done_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_data');
    }
};
