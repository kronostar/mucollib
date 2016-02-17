<?php
class Artists extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'name',
			'sort' 
	);
	public static $rules = array (
			'name' => 'required|not_in:Display Name',
			'sort' => 'required|not_in:Sort Name' 
	);
	public $messages;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'artists';
	
	/**
	 * Get the albums associated with the artist
	 */
	public function Albums() {
		return $this->hasMany ( 'albums' );
	}
	public function isValid() {
		$validation = Validator::make ( $this->attributes, static::$rules );
		if ($validation->passes ())
			return true;
		$this->messages = $validation;
		return false;
	}
}