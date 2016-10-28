@extends('layouts.default')
<!-- mucollib/app/views/artists/edit.blade.php -->

@section('content')

  {{ Form::model($artist, array('route' => array('artists.update', $artist->id), 'method' => 'put','class' => 'form-artist')) }}
	<h1>Edit Artist</h1>
    {{ Form::label('name', '', array('class' => 'sr-only')) }}
    {{ Form::text('name', $artist->name, array('class' => 'form-control')) }}
    {{ $errors->first('name') }}
    {{ Form::label('sort', '', array('class' => 'sr-only')) }}
    {{ Form::text('sort', $artist->sort, array('class' => 'form-control')) }}
    {{ $errors->first('sort') }}
    {{ Form::submit('Update',array('class' => 'btn btn-lg btn-primary btn-block')) }}
  {{ Form::close() }}

@stop