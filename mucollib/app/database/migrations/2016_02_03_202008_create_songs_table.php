<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('songs', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->string('name',120);
			$table->time('length')->nullable();
			$table->unsignedInteger('number');
			$table->unsignedinteger('album_id');
			$table->foreign('album_id')->references('id')->on('albums');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('songs');
	}

}
