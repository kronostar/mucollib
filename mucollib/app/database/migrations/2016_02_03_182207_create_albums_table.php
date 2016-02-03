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
			$table->unsignedInteger('artist_id')->references('id')->on('artists');
			$table->unsignedInteger('format_id')->references('id')->on('formats');
			$table->unsignedInteger('genre_id')->references('id')->on('genres');
			$table->unsignedInteger('label_id')->references('id')->on('labels');
			$table->unsignedInteger('origlabel_id')->references('id')->on('labels');
			$table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
			$table->foreign('format_id')->references('id')->on('formats')->onDelete('cascade');
			$table->foreign('genre_id')->references('id')->on('genres');
			$table->foreign('label_id')->references('id')->on('labels');
			$table->foreign('origlabel_id')->references('id')->on('labels');
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
