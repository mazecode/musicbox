<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistGenresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_genres', function (Blueprint $table) {
            $table->unsignedBigInteger('artist_id')->index();
            $table->unsignedBigInteger('genre_id')->index();

            $table->unique(['artist_id', 'genre_id']);

            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('SET NULL');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('SET NULL');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artist_genres');
    }

}
