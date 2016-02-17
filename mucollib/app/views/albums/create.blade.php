@extends('layouts.default') 
<!-- mucollib/app/views/albums/create.blade.php -->

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
	{{ Form::open(array('route' => 'albums.store','class' => 'form-album')) }}
		<h1>New Album</h1>
		{{ Form::label('artist_id', '', array('class' => 'sr-only')) }} 
		{{ Form::select('artist_id', $artists, '0', array('class' => 'form-control')) }} 
		{{ $errors->first('artist_id') }}
		{{ Form::label('name', '', array('class' => 'sr-only')) }} 
		{{ Form::text('name', 'Title', array('class' => 'form-control')) }} 
		{{ $errors->first('name') }}
		{{ Form::label('year', 'Released:') }} 
		{{ Form::select('year', $years, date("Y")) }} 
		{{ Form::label('origyear', 'Originally released:') }} 
		{{ Form::select('origyear', $years, date("Y")) }}
		{{ Form::label('catno', '', array('class' => 'sr-only')) }} 
		{{ Form::text('catno', 'Catalogue Number', array('class' => 'form-control')) }} 
		{{ Form::label('origcatno', '', array('class' => 'sr-only')) }} 
		{{ Form::text('origcatno', 'Original Catalogue Number', array('class' => 'form-control')) }}
		{{ Form::label('format_id', '', array('class' => 'sr-only')) }} 
		{{ Form::select('format_id', $formats, '0', array('class' => 'form-control')) }} 
		{{ $errors->first('format_id') }} 
		{{ Form::label('genre_id', '', array('class' => 'sr-only')) }} 
		{{ Form::select('genre_id', $genres, '0', array('class' => 'form-control'))	}}
		{{ $errors->first('genre_id') }} 
		{{ Form::label('label_id', 'Label:') }} 
		{{ Form::select('label_id', $labels, '0', array('class' => 'form-control'))	}}
		{{ $errors->first('label_id') }} 
		{{ Form::label('origlabel_id', 'Original Label:') }} 
		{{ Form::select('origlabel_id', $labels, '0', array('class' => 'form-control'))	}}
		{{ $errors->first('origlabel_id') }} 
		{{ Form::submit('Add',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }} 
@stop
