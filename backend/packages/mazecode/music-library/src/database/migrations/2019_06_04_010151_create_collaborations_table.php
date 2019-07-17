<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaborationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborations', function (Blueprint $table) {
            $table->unsignedBigInteger('artist_id')->index();
            $table->unsignedBigInteger('feat_id')->index();
            $table->unsignedBigInteger('track_id')->index();

            $table->unique(['artist_id', 'feat_id', 'track_id']);

            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('SET NULL');
            $table->foreign('feat_id')->references('id')->on('artists')->onDelete('SET NULL');
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
        Schema::drop('collaborations');
    }
}
