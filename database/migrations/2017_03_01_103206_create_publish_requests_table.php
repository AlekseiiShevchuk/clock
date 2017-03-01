<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('publish_requests')) {
            Schema::create('publish_requests', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('player_movie_id')->unsigned()->nullable();
                $table->foreign('player_movie_id', 'fk_16268_playermovie_player_movie_id_publish_reque')->references('id')->on('player_movies')->onDelete('cascade');
                $table->integer('published_to_movie_id')->unsigned()->nullable();
                $table->foreign('published_to_movie_id', 'fk_16268_playermovie_published_to')->references('id')->on('movies')->onDelete('cascade');
                $table->tinyInteger('is_published')->default(0);
                
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
        Schema::dropIfExists('publish_requests');
    }
}
