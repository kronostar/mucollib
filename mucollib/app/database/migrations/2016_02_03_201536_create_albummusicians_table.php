<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbummusiciansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albummusicians', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->unsignedInteger('musician_id');
			$table->unsignedInteger('album_id');
			$table->unsignedInteger('musicianstatus_id');
			$table->foreign('musician_id')->references('id')->on('musicians');
			$table->foreign('album_id')->references('id')->on('albums');
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
		Schema::drop('albummusicians');
	}

}
