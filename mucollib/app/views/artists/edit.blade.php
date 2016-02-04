
@extends('layouts.default')

@section('content')
  <h1>Edit Artist</h1>
  <br>

  {{ Form::model($artist, array('route' => array('artist.update', $artist->id), 'method' => 'put')) }}
    
    <div>
      {{ Form::label('name', 'Display Name: ') }}
      {{ Form::text('name', $artist->Name) }}
      {{ $errors->first('name') }}
    </div>
    
    <div>
      {{ Form::label('sort', 'Sort Name: ') }}
      {{ Form::text('sort', $artist->Sort) }}
      {{ $errors->first('sort') }}
    </div>
    
    <div>
      {{ Form::submit('Save') }}
    </div>
  {{ Form::close() }}

@stop