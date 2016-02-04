<?php
class AlbumController extends \BaseController {
	protected $album;
	public function __construct(Album $album) {
		$this->album = $album;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$albums = $this->album->all ();
		return View::make ( 'album.index' )->with ( 'albums', $albums );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$artist = Artist::lists ( 'name', 'id' );
		$format = Format::lists ( 'name', 'id' );
		$genre = Genre::lists ( 'name', 'id' );
		$label = Label::lists ( 'name', 'id' );
		return View::make ( 'album.create' )->with ( 'artist', $artist )->with ( 'format', $format )->with ( 'genre', $genre )->with ( 'label', $label );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function update($id) {
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id) {
		//
	}
}
