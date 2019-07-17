<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandIntegrantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('band_integrants', function (Blueprint $table) {
            $table->unsignedBigInteger('band_id')->index();
            $table->unsignedBigInteger('artist_id')->index();

            $table->unique(['band_id', 'artist_id']);

            $table->foreign('band_id')->references('id')->on('artists')->onDelete('SET NULL');
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('SET NULL');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('band_integrantsbands');
    }
}
