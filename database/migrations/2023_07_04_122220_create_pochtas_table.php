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
            $table->string('fish', 100);
            $table->string('dataBirth', 30);
            $table->string('tel_nomer', 20);
            $table->string('passport', 15);
            $table->string('jshshir', 15);
            $table->string('lavozim', 50);
            $table->string('login', 30);
            $table->string('parol', 100);
            $table->string('maqsad');
            $table->unsignedTinyInteger('status')->default(0);
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