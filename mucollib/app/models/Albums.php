<?php
class Albums extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'name',
			'year',
			'catno',
			'origyear',
			'origcatno' 
	);
	public static $rules = array (
			'name' => 'required',
			'Artist_id' => 'required',
			'Format_id' => 'required' 
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
	public function Artist() {
		return $this->belongsTo ( 'artists' );
	}
	
	/**
	 * Get the media format of the Album
	 */
	public function Format() {
		return $this->belongsTo ( 'formats' );
	}
	
	/**
	 * Get the genre of the Album
	 */
	public function Genre() {
		return $this->belongsTo ( 'genres' );
	}
	
	/**
	 * Get the label of the Album
	 */
	public function Label() {
		return $this->belongsTo ( 'labels' );
	}
	public function isValid() {
		$validation = Validator::make ( $this->attributes, static::$rules );
		if ($validation->passes ())
			return true;
		$this->messages = $validation;
		return false;
	}
}
