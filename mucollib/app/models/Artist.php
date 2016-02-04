<?php
class Artist extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'name',
			'sort' 
	);
	public static $rules = array (
			'name' => 'required',
			'sort' => 'required' 
	);
	public $messages;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Artist';
	
	/**
	 * Get the albums associated with the artist
	 */
	public function Albums() {
		return $this->hasMany ( 'Album' );
	}
	public function isValid() {
		$validation = Validator::make ( $this->attributes, static::$rules );
		if ($validation->passes ())
			return true;
		$this->messages = $validation;
		return false;
	}
}