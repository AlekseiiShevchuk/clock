<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('movies')) {
            Schema::create('movies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('movie_file');
                $table->string('answer');
                $table->integer('level_id')->unsigned()->nullable();
                $table->foreign('level_id', 'fk_14854_level_level_id_movie')->references('id')->on('levels')->onDelete('cascade');
                $table->integer('language_id')->unsigned()->nullable();
                $table->foreign('language_id', 'fk_14853_language_language_id_movie')->references('id')->on('languages')->onDelete('cascade');
                
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
        Schema::dropIfExists('movies');
    }
}
