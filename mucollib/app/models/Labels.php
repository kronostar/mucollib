<?php
class Labels extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'name' 
	);
	public static $rules = array (
			'name' => 'required|not_in:Label' 
	);
	public $messages;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'labels';
	
	/**
	 * Get the albums associated with the label
	 */
	public function Album() {
		return $this->hasMany ( 'Albums' );
	}
	public function isValid() {
		$validation = Validator::make ( $this->attributes, static::$rules );
		if ($validation->passes ())
			return true;
		$this->messages = $validation;
		return false;
	}
}