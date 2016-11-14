<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear our table
    	DB::table('genres')->delete();

    	// add 2 genres
    	Genre::create(array(
    		'name' => 'Rock'
    		));

    	Genre::create(array(
    		'name' => 'Progressive'
    		));
    }
}
