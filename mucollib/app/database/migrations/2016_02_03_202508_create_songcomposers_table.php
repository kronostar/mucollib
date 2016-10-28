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
			$table->unsignedInteger('artists_id');
			$table->unsignedInteger('songs_id');
			$table->foreign('artists_id')->references('id')->on('artists')->onDelete('cascade');
			$table->foreign('songs_id')->references('id')->on('songs')->onDelete('cascade');
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
