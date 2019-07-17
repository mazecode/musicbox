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

		$userTable = Arr::get($config, 'users.name') ?? 'users';
		$userId =  Arr::get($config, 'users.id') ?? 'id';

        Schema::create('playlist_interactions', function (Blueprint $table) use ($userTable, $userId) {
            $table->bigIncrements('user_id')->index();
			$table->bigIncrements('playlist_id')->index()
            $table->boolean('liked')->default(false);
			$table->integer('play_count')->default(0);

			$table->unique(['user_id', 'playlist_id']);

            $table->foreign('user_id')->references($userId)->on($userTable)->onDelete('CASCADE');
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('CASCADE');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('playlist_interactions');
	}
}
