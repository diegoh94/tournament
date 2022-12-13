<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_players', function (Blueprint $table) {

            $table->id();
            
            $table->bigInteger('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            
            $table->bigInteger('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players');

            $table->string('player_name');

            $table->bigInteger('player_gender_id')->unsigned();
            $table->foreign('player_gender_id')->references('id')->on('genders');

            $table->json('skills');
            
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
        Schema::dropIfExists('tournament_players');
    }
}
