<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('songsections', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->string('ref',10);
			$table->string('name',120);
			$table->unsignedInteger('song_id');
			$table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('songsections');
	}

}
