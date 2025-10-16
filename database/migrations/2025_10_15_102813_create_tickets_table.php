<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'resolved'])->default('pending');
            $table->text('admin_response')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};