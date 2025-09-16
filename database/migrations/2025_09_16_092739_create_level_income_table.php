<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // In the migration file
public function up()
{
    Schema::create('level_incomes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('from_user_id'); // User who made the purchase
        $table->unsignedBigInteger('to_user_id');   // User who receives commission
        $table->decimal('amount', 10, 2);
        $table->decimal('percentage', 5, 2);
        $table->integer('level');
        $table->text('description')->nullable();
        $table->timestamps();
        
        $table->foreign('from_user_id')->references('id')->on('users');
        $table->foreign('to_user_id')->references('id')->on('users');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_income');
    }
};
