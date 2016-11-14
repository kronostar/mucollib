<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFormatRequest;
use App\Format;
use View;
use Input;
use Redirect;

class FormatController extends Controller
{
    protected $formats;
    public function __construct(Format $formats) {
        $this->formats = $formats;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make ( 'formats.create' );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreFormatRequest $request)
    {
        $input = Input::all ();
        $this->formats->fill ( $input );
        $this->formats->save ();
        return Redirect::route ( 'albums.create' );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
