<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// clear our table
    	DB::table('artists')->delete();

    	// add 3 artists
    	Artist::create(array(
    		'name' => 'Jon Anderson',
    		'sort' => 'Anderson, Jon'
    		));

    	Artist::create(array(
    		'name' => 'Ian Anderson',
    		'sort' => 'Anderson, Ian'
    		));

    	Artist::create(array(
    		'name' => 'John Lees\' Barclay James Harvest',
    		'sort' => 'Lees\' Barclay James Harvest, John'
    		));

    }
}
