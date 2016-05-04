<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongmusiciansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('songmusicians', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->unsignedInteger('musicians_id');
			$table->unsignedInteger('songs_id');
			$table->unsignedInteger('musicianstatus_id');
			$table->foreign('musicians_id')->references('id')->on('musicians')->onDelete('cascade');
			$table->foreign('songs_id')->references('id')->on('songs')->onDelete('cascade');
			$table->foreign('musicianstatus_id')->references('id')->on('musicianstatus');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('songmusicians');
	}

}
