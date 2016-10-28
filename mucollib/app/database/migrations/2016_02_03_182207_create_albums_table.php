<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->string('name',120);
			$table->string('year',4);
			$table->string('catno',20)->nullable();
			$table->string('origyear',4)->nullable();
			$table->string('origcatno',20)->nullable();
			$table->unsignedInteger('artists_id')->references('id')->on('artists');
			$table->unsignedInteger('formats_id')->references('id')->on('formats');
			$table->unsignedInteger('genres_id')->references('id')->on('genres');
			$table->unsignedInteger('labels_id')->references('id')->on('labels');
			$table->unsignedInteger('origlabels_id')->references('id')->on('labels');
			$table->foreign('artists_id')->references('id')->on('artists')->onDelete('cascade');
			$table->foreign('formats_id')->references('id')->on('formats')->onDelete('cascade');
			$table->foreign('genres_id')->references('id')->on('genres');
			$table->foreign('labels_id')->references('id')->on('labels');
			$table->foreign('origlabels_id')->references('id')->on('labels');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('albums');
	}

}
