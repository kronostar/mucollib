@extends('layouts.default')
<!-- mucollib/app/views/genres/create.blade.php -->

@section('content')
	{{ Form::open(array('route' => 'genres.store','class' => 'form-artist')) }}
		<h1>New Genre</h1>
		{{ Form::label('name', '', array('class' => 'sr-only')) }}
		{{ Form::text('name', 'Genre', array('class' => 'form-control')) }}
		{{ $errors->first('name') }}
		{{ Form::submit('Add',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }}
@endsection
