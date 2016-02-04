<?php
class AlbumsController extends \BaseController {
	protected $albums;
	public function __construct(Albums $albums) {
		$this->albums = $albums;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$albums = $this->albums->all ();
		return View::make ( 'albums.index' )->with ( 'albums', $albums );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$artists = Artists::lists ( 'name', 'id' );
		$formats = Formats::lists ( 'name', 'id' );
		$genres = Genres::lists ( 'name', 'id' );
		$labels = Labels::lists ( 'name', 'id' );
		return View::make ( 'albums.create' )->with ( 'artists', $artists )->with ( 'formats', $formats )->with ( 'genres', $genres)->with ( 'labels', $labels );
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
