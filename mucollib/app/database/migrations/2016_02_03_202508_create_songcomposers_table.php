<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongcomposersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('songcomposers', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->unsignedInteger('artist_id');
			$table->unsignedInteger('song_id');
			$table->foreign('artist_id')->references('id')->on('artists');
			$table->foreign('song_id')->references('id')->on('songs');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('songcomposers');
	}

}
