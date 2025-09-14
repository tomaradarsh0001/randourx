<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('downlines', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ancestor_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('descendant_id')->constrained('users')->cascadeOnDelete();
        $table->unsignedInteger('depth'); // 0 = self, 1 = direct sponsor, 2+ = higher levels
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downlines');
    }
};
