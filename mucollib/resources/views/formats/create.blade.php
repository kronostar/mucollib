@extends('layouts.default')
<!-- mucollib/app/views/formats/create.blade.php -->

@section('content')
	{{ Form::open(array('route' => 'formats.store','class' => 'form-artist')) }}
		<h1>New Format</h1>
		{{ Form::label('name', '', array('class' => 'sr-only')) }}
		{{ Form::text('name', 'Format', array('class' => 'form-control')) }}
		{{ $errors->first('name') }}
		{{ Form::submit('Add',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }}
@endsection
