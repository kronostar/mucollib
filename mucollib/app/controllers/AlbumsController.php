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
		$artists = array('Select Artist');
		$artists += Artists::orderBy ( 'sort' )->lists ( 'name', 'id' );
		$currentYear = date("Y");
		$years = range($currentYear, 1900);
		$formats = array('Select Format');
		$formats += Formats::lists ( 'name', 'id' );
		$genres = array('Select Genres');
		$genres += Genres::lists ( 'name', 'id' );
		$labels = array('Select Label');
		$labels += Labels::lists ( 'name', 'id' );
		return View::make ( 'albums.create' )->with ( 'artists', $artists )->with ('years', $years)->with ( 'formats', $formats )->with ( 'genres', $genres)->with ( 'labels', $labels );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
		$input = Input::all ();
		//dd($input);
		if (! $this->albums->fill ( $input )->isValid ()) {
			return Redirect::route ( 'albums.create' )->withInput ()->withErrors ( $this->albums->messages );
		}
		
		$this->albums->save ();
		
		return Redirect::route ( 'artists.index' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id) {
		$album = $this->albums->find ( $id );
		return View::make ( 'albums.show' )->with ( 'album', $album );
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
