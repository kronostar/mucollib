<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Album extends Model
{
	public $timestamps = false;
	protected $fillable = array (
		'artist_id',
		'name',
		'year',
		'origyear',
		'catno',
		'origcatno',
		'format_id',
		'genre_id',
		'label_id',
		'origlabel_id'
		);
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'albums';
	
	/**
	 * Get the artist associated with the album
	 */
	public function artist() {
		return $this->belongsTo ( 'App\Artist' );
	}
	
	/**
	 * Get the media format of the Album
	 */
	public function format() {
		return $this->belongsTo ( 'App\Format' );
	}
	
	/**
	 * Get the genre of the Album
	 */
	public function genre() {
		return $this->belongsTo ( 'App\Genre' );
	}
	
	/**
	 * Get the label of the Album
	 */
	public function label() {
		return $this->belongsTo ( 'App\Label' );
	}
}
