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
Route::resource('artist', 'ArtistController');
Route::resource('album', 'AlbumController');
Route::resource('format', 'FormatController');
Route::resource('genre', 'GenreController');
Route::resource('label', 'LabelController');

Route::get('/', function()
{
	return View::make('hello');
});