<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackGenresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_genres', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->unsignedBigInteger('track_id');
            $table->unsignedBigInteger('genre_id');
            // $table->timestamps();
            // $table->softDeletes();

            $table->foreign('track_id')->references('id')->on('tracks');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->index(['track_id', 'genre_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('track_genres');
    }

}
