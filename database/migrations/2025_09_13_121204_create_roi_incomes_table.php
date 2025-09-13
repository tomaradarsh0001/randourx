<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roi_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('from_admin')->default(1); // always 1
            $table->decimal('wallet_value', 15, 2); // wallet3 before ROI
            $table->decimal('roi_bonus', 15, 2);   // bonus credited
            $table->timestamp('timing')->useCurrent(); // time of credit
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roi_incomes');
    }
};
