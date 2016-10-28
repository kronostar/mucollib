<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::resource('artists', 'ArtistsController');
Route::resource('albums', 'AlbumsController');
Route::resource('formats', 'FormatsController');
Route::resource('genres', 'GenresController');
Route::resource('labels', 'LabelsController');

Route::get('/', function()
{
	return View::make('hello');
});