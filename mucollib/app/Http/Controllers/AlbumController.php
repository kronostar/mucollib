<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAlbumRequest;
use App\Artist;
use App\Album;
use App\Format;
use App\Genre;
use App\Label;
use View;
use Redirect;
use Input;

class AlbumController extends Controller
{
    protected $albums;
    public function __construct(Album $albums) {
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
        $artists = Artist::orderBy ( 'sort' )->pluck ( 'name', 'id' );
        $artists->prepend('Select Artist', 0);
        $formats = Format::pluck ( 'name', 'id' );
        $formats->prepend('Select Format', 0);
        $genres = Genre::pluck ( 'name', 'id' );
        $genres->prepend('Select Genre', 0);
        $labels = Label::pluck ( 'name', 'id' );
        return View::make ( 'albums.create' )->with ( 'artists', $artists )->with ( 'formats', $formats )->with ( 'genres', $genres)->with ( 'labels', $labels );
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreAlbumRequest $request) {
        $input = Input::all();
        $this->albums->fill ( $input );
        $this->albums->save ();
        return Redirect::route ( 'albums.show', $this->albums->id );
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
        $album = $this->albums->find ( $id );
        $artists = Artist::orderBy('sort')->pluck ( 'name', 'id' );
        $formats = Format::pluck ( 'name', 'id' );
        $genres = Genre::pluck ( 'name', 'id' );
        $labels = Label::pluck ( 'name', 'id' );
        return View::make ( 'albums.edit' )->with ( 'album', $album )->with ( 'artists', $artists )->with ( 'formats', $formats )->with ( 'genres', $genres)->with ( 'labels', $labels );
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param int $id           
     * @return Response
     */
    public function update(StoreAlbumRequest $request, $id) {
        $input = Input::all();
        $this->albums->fill ( $input );
        $this->albums->find ( $id )->update ( $input );
        return Redirect::route ( 'albums.show', $id );
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
