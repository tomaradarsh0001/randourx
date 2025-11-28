<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_fund_transfers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('fund_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users');
            $table->foreignId('to_user_id')->constrained('users');
            $table->decimal('amount', 15, 2);
            $table->string('wallet_type')->default('wallet1'); // wallet1, wallet2, etc.
            $table->text('description')->nullable();
            $table->string('status')->default('completed'); // completed, pending, failed
            $table->string('reference_id')->unique();
            $table->timestamps();

            $table->index('from_user_id');
            $table->index('to_user_id');
            $table->index('reference_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fund_transfers');
    }
}