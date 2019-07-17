<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->unique();
            $table->string('slug', 200)->unique();
            $table->date('birthday')->nullable();
            $table->longText('bio')->nullable();
            $table->json('influences')->nullable();
            $table->boolean('is_music_band')->default(false);
			$table->unsignedBigInteger('band_id')->nullable()->index();
			$table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'band_id']);

            $table->foreign('band_id')->references('id')->on('artists')->onDelete('SET NULL');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artists');
    }
}
