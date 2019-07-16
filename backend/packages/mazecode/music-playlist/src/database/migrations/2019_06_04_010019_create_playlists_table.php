<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

class CreatePlaylistsTable extends Migration
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

		Schema::create('playlists', function (Blueprint $table) use ($userId, $userTable) {
			$table->bigIncrements('id');
			$table->string('name', 200)->unique();
			$table->integer('count_tracks')->default(0);
			$table->unsignedBigInteger('user_id')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('user_id')->references($userId)->on($userTable);
			$table->index(['id', 'name']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('playlists');
	}
}
