<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLabelRequest;
use App\Label;
use View;
use Input;
use Redirect;

class LabelController extends Controller
{
    protected $labels;
    public function __construct(Label $labels) {
        $this->labels = $labels;
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
        return View::make ( 'labels.create' );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreLabelRequest $request)
    {
        $input = Input::all ();
        $this->labels->fill ( $input );
        $this->labels->save ();
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
