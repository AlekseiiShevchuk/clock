<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerMovieCollectionPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_movie_collection_player', function (Blueprint $table) {
            $table->integer('player_movie_collection_id')->unsigned()->nullable();
            $table->foreign('player_movie_collection_id', 'fk_p_player_movie_collection_id')->references('id')->on('player_movie_collections');
            $table->integer('player_id')->unsigned()->nullable();
            $table->foreign('player_id', 'fk_p_player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_movie_collection_player');
    }
}
