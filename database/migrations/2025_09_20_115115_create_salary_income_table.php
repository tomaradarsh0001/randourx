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
        Schema::create('salary_income', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('target_level', ['30_days', '60_days', '90_days']);
            $table->decimal('target_amount', 10, 2);
            $table->decimal('user_wallet3_amount', 10, 2);
            $table->decimal('calculated_percentage', 5, 2);
            $table->decimal('credited_amount', 10, 2);
            $table->text('description');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->index('target_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_income');
    }
};