<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('artists', 'ArtistController');
Route::resource('albums', 'AlbumController');
Route::resource('formats', 'FormatController');
Route::resource('genres', 'GenreController');
Route::resource('labels', 'LabelController');
