<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	public $timestamps = false;
	protected $fillable = array (
		'name' 
		);
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'genres';
	
	/**
	 * Get the albums associated with the format
	 */
	public function album() {
		return $this->hasMany ( 'App\Album' );
	}
}
