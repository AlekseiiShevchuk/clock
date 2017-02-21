<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('player_movies')) {
            Schema::create('player_movies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('player_id')->unsigned()->nullable();
                $table->foreign('player_id', 'fk_16256_player_player_id_player_movie')->references('id')->on('players')->onDelete('cascade');
                $table->integer('language_id')->unsigned()->nullable();
                $table->foreign('language_id', 'fk_14853_language_language_id_player_movie')->references('id')->on('languages')->onDelete('cascade');
                $table->integer('collection_id')->unsigned()->nullable();
                $table->foreign('collection_id', 'fk_16267_player_movie_collection_collection_id_playe')->references('id')->on('player_movie_collections')->onDelete('cascade');
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('answer');
                $table->string('movie_file');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
