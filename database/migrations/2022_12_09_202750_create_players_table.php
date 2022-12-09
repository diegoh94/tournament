<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender'); // m - f
            $table->integer('skill_level')->default(0); // 0 - 100
            $table->integer('strength')->default(0); // 0 - 100
            $table->integer('velocity_of_displacement')->default(0); // 0 - 100
            $table->integer('reaction_time')->default(0); // 0 - 100
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
        Schema::dropIfExists('players');
    }
}
