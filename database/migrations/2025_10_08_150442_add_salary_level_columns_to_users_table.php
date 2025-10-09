<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('total_business_downline', 15, 2)->default(0);
            $table->boolean('level_1_achieved')->default(false);
            $table->boolean('level_2_achieved')->default(false);
            $table->boolean('level_3_achieved')->default(false);
            $table->timestamp('level_1_achieved_at')->nullable();
            $table->timestamp('level_2_achieved_at')->nullable();
            $table->timestamp('level_3_achieved_at')->nullable();
            $table->timestamp('business_updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'total_business_downline',
                'level_1_achieved',
                'level_2_achieved',
                'level_3_achieved',
                'level_1_achieved_at',
                'level_2_achieved_at',
                'level_3_achieved_at',
                'business_updated_at'
            ]);
        });
    }
};