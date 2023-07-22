<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePochtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pochtas', function (Blueprint $table) {
            $table->id();
            $table->string('fullName', 100);
            $table->string('birthdate', 30);
            $table->string('phoneNumber', 20);
            $table->string('passport', 15);
            $table->string('pinfl', 15);
            $table->string('position', 50);
            $table->string('login', 30);
            $table->string('password', 100);
            $table->string('message');
            $table->string('status')->default("Yangi");
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pochtas');
    }
}