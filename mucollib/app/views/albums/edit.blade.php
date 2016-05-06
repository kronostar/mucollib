@extends('layouts.default') 
<!-- mucollib/app/views/albums/edit.blade.php -->

@section('content')
	<div class='row'>
		<div class='col-xs-12 col-sm-4'>
			<form action='/formats/create'>
				{{ Form::submit('Add Format',array('class' => 'btn btn-lg btn-primary btn-block')) }}
			</form>
		</div>
		<div class='col-xs-12 col-sm-4'>
			<form action='/genres/create'>
				{{ Form::submit('Add Genre',array('class' => 'btn btn-lg btn-primary btn-block')) }}
			</form>
		</div>
		<div class='col-xs-12 col-sm-4'>
			<form action='/labels/create'>
				{{ Form::submit('Add Label',array('class' => 'btn btn-lg btn-primary btn-block')) }}
			</form>
		</div>
	</div>
	{{ Form::model($album, array('route' => array('albums.update', $album->id), 'method' => 'put','class' => 'form-album')) }}
		<h1>Edit Album</h1>
  		{{ Form::label('artists_id', '', array('class' => 'sr-only')) }}
		{{ Form::select('artists_id', $artists, "$album->artists_id", array('class' => 'form-control')) }} 
  		{{ $errors->first('artists_id') }}
		{{ Form::label('name', '', array('class' => 'sr-only')) }} 
		{{ Form::text('name', $album->name, array('class' => 'form-control')) }} 
		{{ $errors->first('name') }}
		{{ Form::label('year', 'Released:') }} 
		{{ Form::selectYear('year', date("Y"), 1900, "$album->year") }} 
		{{ Form::label('origyear', 'Originally released:') }} 
		{{ Form::selectYear('origyear', date("Y"), 1900, "$album->origyear") }}
		{{ Form::label('catno', '', array('class' => 'sr-only')) }} 
		{{ Form::text('catno', $album->catno, array('class' => 'form-control')) }} 
		{{ Form::label('origcatno', '', array('class' => 'sr-only')) }} 
		{{ Form::text('origcatno', $album->origcatno, array('class' => 'form-control')) }}
		{{ Form::label('formats_id', '', array('class' => 'sr-only')) }} 
		{{ Form::select('formats_id', $formats, "$album->formats_id", array('class' => 'form-control')) }} 
		{{ $errors->first('formats_id') }} 
		{{ Form::label('genres_id', '', array('class' => 'sr-only')) }} 
		{{ Form::select('genres_id', $genres, "$album->genres_id", array('class' => 'form-control'))	}}
		{{ $errors->first('genres_id') }} 
		{{ Form::label('labels_id', 'Label:') }} 
		{{ Form::select('labels_id', $labels, "$album->labels_id", array('class' => 'form-control'))	}}
		{{ $errors->first('labels_id') }} 
		{{ Form::label('origlabels_id', 'Original Label:') }} 
		{{ Form::select('origlabels_id', $labels, "$album->origlabels_id", array('class' => 'form-control'))	}}
		{{ $errors->first('origlabels_id') }} 
    	{{ Form::submit('Update',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }} 
@stop
