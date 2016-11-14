<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArtistRequest;
use App\Artist;
use App\Album;
use Input;
use View;
use Redirect;

class ArtistController extends Controller
{
    protected $artists;
    public function __construct(Artist $artists) {
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
		$artists = Artist::orderBy('sort')
			->where('sort', 'LIKE', $id)
			->get();
        if ($artists->count ()) {
			$albums = Album::select('albums.id','albums.name')
				->leftjoin('artists', 'albums.artist_id', '=', 'artists.id')
				->orderBy('artists.sort')
				->where ('artists.sort', 'LIKE', $id)
				->get();
        } else {
            $albums = Album::all ();
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
    public function store(StoreArtistRequest $request) {
        $input = Input::all ();
        $this->artists->fill ( $input );
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
        $albums = $artist->albums;
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
    public function update(StoreArtistRequest $request, $id) {
        $input = Input::all();
        $this->artists->fill ( $input );
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
