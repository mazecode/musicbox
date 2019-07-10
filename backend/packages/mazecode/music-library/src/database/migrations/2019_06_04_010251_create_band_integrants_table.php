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
            // $table->bigIncrements('id');
            $table->unsignedBigInteger('band_id');
            $table->unsignedBigInteger('artist_id');
            // $table->timestamps();
            // $table->softDeletes();

            $table->foreign('band_id')->references('id')->on('artists');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->index(['band_id', 'artist_id']);
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
