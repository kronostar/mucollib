@extends('layouts.default') 
<!-- mucollib/app/views/albums/create.blade.php -->

@section('content')

	{{ Form::open(array('route' => 'albums.store','class' => 'form-album')) }}
		<h1>Create New Album</h1>
		<div class="row">
			<div class="col-xs-12 col-sm-5">
				{{ Form::label('artist', 'Artist: ') }} 
				{{ Form::select('artist_id', $artists ) }} 
				{{ $errors->first('artists') }}
			</div>
			<div class="col-xs-12 col-sm-6">
				{{ Form::label('name', 'Title: ') }} 
				{{ Form::text('name') }} 
				{{ $errors->first('name') }}
			</div>
			<div class="col-xs-12 col-sm-6">
				{{ Form::label('year', 'Release year: ') }} 
				{{ Form::text('year') }} 
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				{{ Form::label('origyear', 'Original Year of release: ') }} 
				{{ Form::text('origyear') }}
			</div>
		</div>
		{{ Form::label('catno', 'Catalogue Number: ') }} 
		{{ Form::text('catno') }} 
		{{ Form::label('origcatno', 'Original Catalogue	Number: ') }} 
		{{ Form::text('origcatno') }}
		{{ Form::label('format', 'Format: ') }} 
		{{ Form::select('format_id', $formats) }} 
		{{ $errors->first('format') }} 
		{{ Form::label('genre', 'Genre: ') }} 
		{{ Form::select('genre_id', $genres)	}}
		{{ Form::submit('Create') }}
	{{ Form::close() }} 
@stop
