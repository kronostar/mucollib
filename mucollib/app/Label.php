<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
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
	protected $table = 'labels';
	
	/**
	 * Get the albums associated with the label
	 */
	public function album() {
		return $this->hasMany ( 'App\Album' );
	}
}
