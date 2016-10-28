@extends('layouts.default')
<!-- mucollib/app/views/artists/create.blade.php -->

@section('content')

  {{ Form::open(array('route' => 'artists.store', 'class' => 'form-artist')) }}
	<h1>New Artist</h1>
	{{ Form::label('name', '', array('class' => 'sr-only')) }}
    {{ Form::text('name', 'Display Name', array('class' => 'form-control')) }}
    {{ $errors->first('name') }}
    {{ Form::label('sort', '', array('class' => 'sr-only')) }}
    {{ Form::text('sort', 'Sort Name', array('class' => 'form-control')) }}
    {{ $errors->first('sort') }}
    {{ Form::submit('Add',array('class' => 'btn btn-lg btn-primary btn-block')) }}
  {{ Form::close() }}

@stop