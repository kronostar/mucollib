<?php
class ArtistsController extends \BaseController {
	protected $artists;
	public function __construct(Artists $artists) {
		$this->artists = $artists;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$id = Input::get ( "begins" );
		$id = $id . '%';
		$artists = $this->artists->orderBy ( 'sort' )->where ( 'sort', 'LIKE', $id )->get ();
		if ($artists->count ()) {
			// select album from albums where artist in artists
			$query = $this->artists->orderBy ( 'sort' )->where ( 'sort', 'LIKE', $id )->lists ( 'id' );
			$albums = Albums::whereIn ( 'artists_id', $query )->get ();
		} else {
			$albums = Albums::all ();
		}
		return View::make ( 'artists.index' )->with ( 'artists', $artists )->with ( 'albums', $albums );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make ( 'artists.create' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all ();
		if (! $this->artists->fill ( $input )->isValid ()) {
			return Redirect::route ( 'artists.create' )->withInput ()->withErrors ( $this->artists->messages );
		}
		
		$this->artists->save ();
		
		return Redirect::route ( 'artists.index' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id) {
		$artist = $this->artists->find ( $id );
		$albums = $artist->Albums()->get();
		return View::make ( 'artists.show' )->with ( 'artist', $artist )->with ( 'albums', $albums );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id) {
		$artist = $this->artists->find ( $id );
		return View::make ( 'artists.edit' )->with ( 'artist', $artist );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function update($id) {
		$input = Input::except ( array (
				'_method',
				'_token' 
		) );
		if (! $this->artists->fill ( $input )->isValid ()) {
			return Redirect::route ( 'artists.edit', $id )->withInput ()->withErrors ( $this->artists->messages );
		}
		$artist = $this->artists->find ( $id )->update ( $input );
		return Redirect::route ( 'artists.index' );
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
