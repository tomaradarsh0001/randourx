<?php

// database/migrations/2025_09_23_000000_create_salary_incomes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryIncomesTable extends Migration
{
    public function up()
    {
        Schema::create('salary_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->decimal('amount', 14, 2);
            $table->decimal('percentage', 5, 2);
            $table->bigInteger('threshold'); // threshold that triggered this
            $table->enum('status', ['pending', 'paid', 'rejected'])->default('pending');
            $table->timestamp('eligible_at')->nullable(); // when created/eligible
            $table->timestamp('paid_at')->nullable();
            $table->date('period_start')->nullable(); // optional
            $table->date('period_end')->nullable();   // optional
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('salary_incomes');
    }
}
