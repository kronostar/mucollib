<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Label;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear our table
    	DB::table('labels')->delete();

    	// add some labels
    	Label::create(array(
    		'name' => 'Unknown'
    		));

			Label::create(array(
    		'name' => 'Esoteric Antenna'
    		));

    	Label::create(array(
    		'name' => 'Atlantic'
    		));

    	Label::create(array(
    		'name' => 'Fuel 2000'
    		));

    }
}
