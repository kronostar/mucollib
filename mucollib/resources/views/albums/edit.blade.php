@extends('layouts.default') 
<!-- mucollib/resources/views/albums/edit.blade.php -->

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
		<div class='divTable'>
			<div class='divTableBody'>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('artist_id', 'Artist:') }}
					</div>
					<div class='divTableCell'>
						{{ Form::select('artist_id', $artists, "$album->artist_id", array('class' => 'form-control')) }}
						{{ $errors->first('artist_id') }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('name', 'Title:') }}
					</div>
					<div class='divTableCell'> 
						{{ Form::text('name', $album->name, array('class' => 'form-control')) }} 
						{{ $errors->first('name') }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('year', 'Released:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::selectYear('year', date("Y"), 1900, "$album->year", array('class' => 'form-control')) }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('origyear', 'First released:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::selectYear('origyear', date("Y"), 1900, "$album->origyear", array('class' => 'form-control')) }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('catno', 'Catalogue Number:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::text('catno', $album->catno, array('class' => 'form-control')) }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('origcatno', 'Original Catalogue Number:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::text('origcatno', $album->origcatno, array('class' => 'form-control')) }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('label_id', 'Label:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('label_id', $labels, "$album->label_id", array('class' => 'form-control'))	}}
						{{ $errors->first('label_id') }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('origlabel_id', 'Original Label:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('origlabel_id', $labels, "$album->origlabel_id", array('class' => 'form-control'))	}}
						{{ $errors->first('origlabel_id') }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('format_id', 'Format:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('format_id', $formats, "$album->format_id", array('class' => 'form-control')) }} 
						{{ $errors->first('format_id') }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('genre_id', 'Genre:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('genre_id', $genres, "$album->genre_id", array('class' => 'form-control'))	}}
						{{ $errors->first('genre_id') }} 
					</div>
				</div>
			</div>
		</div>
    	{{ Form::submit('Update',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }} 
@endsection
