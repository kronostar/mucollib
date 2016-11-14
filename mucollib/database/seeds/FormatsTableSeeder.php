<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Format;

class FormatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear our table
    	DB::table('formats')->delete();

    	// add 2 formats
    	Format::create(array(
    		'name' => 'Vinyl'
    		));

    	Format::create(array(
    		'name' => 'CD'
    		));

    }
}
