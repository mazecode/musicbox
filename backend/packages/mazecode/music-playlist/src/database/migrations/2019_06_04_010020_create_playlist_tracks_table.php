<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

class CreatePlaylistTracksTable extends Migration
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

		Schema::create('playlist_tracks', function (Blueprint $table) use ($trackId, $trackTable) {
			$table->unsignedBigInteger('playlist_id')->index();
			$table->unsignedBigInteger('track_id')->index();

			$table->unique(['playlist_id', 'track_id']);

			$table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('SET NULL');
			$table->foreign('track_id')->references($trackId)->on($trackTable)->onDelete('SET NULL');
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
