<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistAlbumsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_albums', function (Blueprint $table) {
            $table->unsignedBigInteger('artist_id')->index();
            $table->unsignedBigInteger('album_id')->index();

            $table->unique(['artist_id', 'album_id']);

            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('SET NULL');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('SET NULL');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artist_albums');
    }

}
