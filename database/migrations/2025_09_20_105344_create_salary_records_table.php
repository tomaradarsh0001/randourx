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
        Schema::create('salary_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('target_30_days', 10, 2)->default(2500);
            $table->decimal('target_60_days', 10, 2)->default(5000);
            $table->decimal('target_90_days', 10, 2)->default(10000);
            $table->boolean('achieved_30_days')->default(false);
            $table->boolean('achieved_60_days')->default(false);
            $table->boolean('achieved_90_days')->default(false);
            $table->dateTime('deadline_30_days');
            $table->dateTime('deadline_60_days');
            $table->dateTime('deadline_90_days');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_records');
    }
};