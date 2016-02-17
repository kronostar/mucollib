<?php
class Albums extends Eloquent {
	public $timestamps = false;
	protected $fillable = array (
			'artist_id',
			'name',
			'year',
			'origyear',
			'catno',
			'origcatno',
			'format_id',
			'genre_id',
			'label_id',
			'origlabel_id'
	);
	public static $rules = array (
			'artist_id' => 'required|not_in:0',
			'name' => 'required|not_in:Title',
			'format_id' => 'required|not_in:0',
			'genre_id' => 'required|not_in:0',
			'label_id' => 'required|not_in:0',
			'origlabel_id' => 'required|not_in:0'
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
