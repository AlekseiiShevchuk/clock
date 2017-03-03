<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToPlayerMovieCollectionTypeStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_movie_collections', function (Blueprint $table) {
            $table->enum('type', ['single_challenge', 'group_challenge'])->nullable();
            $table->enum('status', ['composing', 'started'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_movie_collections', function (Blueprint $table) {
            //
        });
    }
}
