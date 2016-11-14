<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Artist;
use App\Album;
use App\Format;
use App\Genre;
use App\Label;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear our table
    	DB::table('albums')->delete();

    	// add some albums
    	$artist = Artist::where('name', '=', 'John Lees\' Barclay James Harvest')->first();
    	$format = Format::where('name', '=', 'CD')->first();
    	$genre = Genre::where('name', '=', 'Progressive')->first();
    	$label = Label::where('name', '=', 'Esoteric Antenna')->first();
    	$label1 = Label::where('name', '=', 'Esoteric Antenna')->first();
    	Album::create(array(
    		'artist_id' => $artist->id,
    		'name' => 'North',
    		'year' => '2013',
    		'origyear' => '2013',
    		'catno' => 'EANTCD 21022',
    		'origcatno' => 'EANTCD 21022',
    		'format_id' => $format->id,
    		'genre_id' => $genre->id,
    		'label_id' => $label->id,
    		'origlabel_id' => $label1->id
    		));

    	$artist = Artist::where('name', '=', 'Jon Anderson')->first();
    	$format = Format::where('name', '=', 'Vinyl')->first();
    	$genre = Genre::where('name', '=', 'Progressive')->first();
    	$label = Label::where('name', '=', 'Atlantic')->first();
    	$label1 = Label::where('name', '=', 'Atlantic')->first();
    	Album::create(array(
    		'artist_id' => $artist->id,
    		'name' => 'Olias Of Sunhillow',
    		'year' => '1976',
    		'origyear' => '1976',
    		'catno' => 'K50261',
    		'origcatno' => 'K50261',
    		'format_id' => $format->id,
    		'genre_id' => $genre->id,
    		'label_id' => $label->id,
    		'origlabel_id' => $label1->id
    		));

    	$artist = Artist::where('name', '=', 'Jon Anderson')->first();
    	$format = Format::where('name', '=', 'CD')->first();
    	$genre = Genre::where('name', '=', 'Progressive')->first();
    	$label = Label::where('name', '=', 'Atlantic')->first();
    	$label1 = Label::where('name', '=', 'Atlantic')->first();
    	Album::create(array(
    		'artist_id' => $artist->id,
    		'name' => 'Song Of Seven',
    		'year' => '1980',
    		'origyear' => '1980',
    		'catno' => '7567-81475-2',
    		'origcatno' => 'SD 16021',
    		'format_id' => $format->id,
    		'genre_id' => $genre->id,
    		'label_id' => $label->id,
    		'origlabel_id' => $label1->id
    		));

    	$artist = Artist::where('name', '=', 'Ian Anderson')->first();
    	$format = Format::where('name', '=', 'CD')->first();
    	$genre = Genre::where('name', '=', 'Progressive')->first();
    	$label = Label::where('name', '=', 'Fuel 2000')->first();
    	$label1 = Label::where('name', '=', 'Fuel 2000')->first();
    	Album::create(array(
    		'artist_id' => $artist->id,
    		'name' => 'The Secret Language of Birds',
    		'year' => '1998',
    		'origyear' => '1998',
    		'catno' => '302 061 053 2',
    		'origcatno' => '302 061 053 2',
    		'format_id' => $format->id,
    		'genre_id' => $genre->id,
    		'label_id' => $label->id,
    		'origlabel_id' => $label1->id
    		));

    }
}
