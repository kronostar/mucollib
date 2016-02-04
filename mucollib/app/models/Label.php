<?php
class Label extends Eloquent {
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
	protected $table = 'Label';
	
	/**
	 * Get the albums associated with the label
	 */
	public function Album() {
		return $this->hasMany ( 'Album' );
	}
}