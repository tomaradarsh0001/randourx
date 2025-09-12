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
       Schema::table('users', function (Blueprint $table) {
            $table->decimal('wallet1', 15, 2)->default(0);
            $table->decimal('wallet2', 15, 2)->default(0);
            $table->decimal('wallet3', 15, 2)->default(0);
            $table->decimal('wallet4', 15, 2)->default(0);
            $table->decimal('income1', 15, 2)->default(0);
            $table->decimal('income2', 15, 2)->default(0);
            $table->decimal('income3', 15, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
