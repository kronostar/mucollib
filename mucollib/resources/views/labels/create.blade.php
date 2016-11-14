@extends('layouts.default')
<!-- mucollib/app/views/labels/create.blade.php -->

@section('content')
	{{ Form::open(array('route' => 'labels.store','class' => 'form-artist')) }}
		<h1>New Label</h1>
		{{ Form::label('name', '', array('class' => 'sr-only')) }}
		{{ Form::text('name', 'Label', array('class' => 'form-control')) }}
		{{ $errors->first('name') }}
		{{ Form::submit('Add',array('class' => 'btn btn-lg btn-primary btn-block')) }}
	{{ Form::close() }}
@endsection
