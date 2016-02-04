<?php
class Formats extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'name' 
	);
	public static $rules = array (
			'name' => 'required' 
	);
	public $messages;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'formats';
	
	/**
	 * Get the albums associated with the format
	 */
	public function Album() {
		return $this->hasMany ( 'albums' );
	}
}