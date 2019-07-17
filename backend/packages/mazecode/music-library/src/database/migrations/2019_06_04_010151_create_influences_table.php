<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfluencesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influences', function (Blueprint $table) {
            $table->unsignedBigInteger('artist_id')->index();
            $table->unsignedBigInteger('influence_id')->index();

            $table->unique(['artist_id', 'influence_id']);

            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('SET NULL');
            $table->foreign('influence_id')->references('id')->on('artists')->onDelete('SET NULL');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('influences');
    }

}
