<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerMovieCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('player_movie_collections')) {
            Schema::create('player_movie_collections', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('player_id')->unsigned()->nullable();
                $table->foreign('player_id', 'fk_16256_player_player_id_player_movie_collection')->references('id')->on('players')->onDelete('cascade');
                $table->integer('language_id')->unsigned()->nullable();
                $table->foreign('language_id', 'fk_14853_language_language_id_player_movie_collectio')->references('id')->on('languages')->onDelete('cascade');
                $table->string('name');
                $table->string('description')->nullable();
                
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
