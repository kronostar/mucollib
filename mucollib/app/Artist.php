<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
	public $timestamps = false;
    protected $fillable = array (
			'name',
			'sort' 
	);
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'artists';
	
	/**
	 * Get the albums associated with the artist
	 */
	public function albums() {
		return $this->hasMany ( 'App\Album' );
	}
}
