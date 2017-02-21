<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('abuses')) {
            Schema::create('abuses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('player_movie_id')->unsigned()->nullable();
                $table->foreign('player_movie_id', 'fk_16268_playerMovie_player_movie_id_abus')->references('id')->on('player_movies')->onDelete('cascade');
                $table->string('description');
                $table->integer('by_player_id')->unsigned()->nullable();
                $table->foreign('by_player_id', 'fk_16256_player_by_player_id_abus')->references('id')->on('players')->onDelete('cascade');
                
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
        Schema::dropIfExists('abuses');
    }
}
