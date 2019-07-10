<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

class CreatePlayListTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$config = config('musicplaylist.tables');
		
		$trackTable =Arr::get($config, 'tracks.name') ?? 'tracks';
		$trackId =Arr::get($config, 'tracks.id') ?? 'id';

		Schema::create('playlist_tracks', function (Blueprint $table) {
			$$table->unsignedBigInteger('playlist_id')->nullable();
			$$table->unsignedBigInteger('track_id')->nullable();

			$table->foreign('playlist_id')->references('id')->on('playlists');
			$table->foreign('track_id')->references($trackId)->on($trackTable);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('playlist_tracks');
	}
}
