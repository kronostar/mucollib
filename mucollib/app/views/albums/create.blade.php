@extends('layouts.default') 

@section('content')
	<h1>Create New Album</h1>
	<br>

	{{ Form::open(array('route' => 'album.store')) }}

	<div>
		{{ Form::label('artist', 'Artist: ') }} 
		{{ Form::select('artist_id', $artist ) }} 
		{{ $errors->first('artist') }}
		{{ Form::label('name', 'Title: ') }} 
		{{ Form::text('name') }} 
		{{ $errors->first('name') }}
	</div>

	<div>
		{{ Form::label('year', 'Year of release: ') }} 
		{{ Form::text('year') }} 
		{{ Form::label('origyear', 'Original Year of release: ') }} 
		{{ Form::text('origyear') }}
	</div>

	<div>
		{{ Form::label('catno', 'Catalogue Number: ') }} 
		{{ Form::text('catno') }} 
		{{ Form::label('origcatno', 'Original Catalogue	Number: ') }} 
		{{ Form::text('origcatno') }}
	</div>

	<div>
		{{ Form::label('format', 'Format: ') }} 
		{{ Form::select('format_id', $format) }} 
		{{ $errors->first('format') }} 
		{{ Form::label('genre', 'Genre: ') }} 
		{{ Form::select('genre_id', $genre)	}}
	</div>

	<div>
		{{ Form::submit('Create') }}
	</div>

	{{ Form::close() }} 
@stop
