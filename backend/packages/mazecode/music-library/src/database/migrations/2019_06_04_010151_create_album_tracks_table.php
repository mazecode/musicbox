<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumTracksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_tracks', function (Blueprint $table) {
            $table->tinyInteger('track_number')->nullable();
            $table->unsignedBigInteger('album_id')->index();
            $table->unsignedBigInteger('track_id')->index();

            $table->unique(['album_id', 'track_id']);

            $table->foreign('album_id')->references('id')->on('albums')->onDelete('SET NULL');
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('SET NULL');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('album_tracks');
    }
}
