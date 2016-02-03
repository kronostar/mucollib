<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusiciansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('musicians', function(Blueprint $table)
		{
			$table->engine='innodb';
			$table->increments('id');
			$table->unsignedInteger('artist_id');
			$table->unsignedInteger('instrument_id');
			$table->foreign('artist_id')->references('id')->on('artists');
			$table->foreign('instrument_id')->references('id')->on('instruments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('musicians');
	}

}
