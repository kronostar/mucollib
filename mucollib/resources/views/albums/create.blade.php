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
		<div class='divTable'>
			<div class='divTableBody'>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('artist_id', 'Artist:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('artist_id', $artists, '0', array('class' => 'form-control')) }} 
						{{ $errors->first('artist_id') }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('name', 'Title:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::text('name', 'Title', array('class' => 'form-control')) }} 
						{{ $errors->first('name') }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('year', 'Released:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::selectYear('year', date("Y"), 1900) }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('origyear', 'First released:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::selectYear('origyear', date("Y"), 1900) }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('catno', 'Catalogue Number:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::text('catno', '', array('class' => 'form-control')) }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('origcatno', 'Original Catalogue Number:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::text('origcatno', '', array('class' => 'form-control')) }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('label_id', 'Label:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('label_id', $labels, '1', array('class' => 'form-control'))	}}
						{{ $errors->first('label_id') }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('origlabel_id', 'Original Label:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('origlabel_id', $labels, '1', array('class' => 'form-control'))	}}
						{{ $errors->first('origlabel_id') }}
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('format_id', 'Format:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('format_id', $formats, '0', array('class' => 'form-control')) }} 
						{{ $errors->first('format_id') }} 
					</div>
				</div>
				<div class='divTableRow'>
					<div class='divTableCell'>
						{{ Form::label('genre_id', 'Genre:') }} 
					</div>
					<div class='divTableCell'>
						{{ Form::select('genre_id', $genres, '0', array('class' => 'form-control'))	}}
						{{ $errors->first('genre_id') }} 
					</div>
				</div>
			</div>
		</div>
		{{ Form::submit('Add',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }} 
@endsection
