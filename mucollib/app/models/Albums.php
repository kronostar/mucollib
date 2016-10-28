<?php
class Albums extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'artists_id',
			'name',
			'year',
			'origyear',
			'catno',
			'origcatno',
			'formats_id',
			'genres_id',
			'labels_id',
			'origlabels_id'
	);
	public static $rules = array (
			'artists_id' => 'required|not_in:0',
			'name' => 'required|not_in:Title',
			'formats_id' => 'required|not_in:0',
			'genres_id' => 'required|not_in:0',
			'labels_id' => 'required|not_in:0',
			'origlabels_id' => 'required|not_in:0'
	);
	public $messages;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'albums';
	
	/**
	 * Get the artist associated with the album
	 */
	public function Artists() {
		return $this->belongsTo ( 'Artists' );
	}
	
	/**
	 * Get the media format of the Album
	 */
	public function Formats() {
		return $this->belongsTo ( 'Formats' );
	}
	
	/**
	 * Get the genre of the Album
	 */
	public function Genres() {
		return $this->belongsTo ( 'Genres' );
	}
	
	/**
	 * Get the label of the Album
	 */
	public function Labels() {
		return $this->belongsTo ( 'Labels' );
	}
	public function isValid() {
		$validation = Validator::make ( $this->attributes, static::$rules );
		if ($validation->passes ())
			return true;
		$this->messages = $validation;
		return false;
	}
}
