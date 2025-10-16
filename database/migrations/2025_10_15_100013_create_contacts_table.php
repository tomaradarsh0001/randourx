<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_contacts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->string('form_id')->nullable();
            $table->string('form_token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}