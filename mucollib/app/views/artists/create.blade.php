@extends('layouts.default')

@section('content')
  <h1>Create New Artist</h1>
  <br>

  {{ Form::open(array('route' => 'artist.store')) }}
    
    <div>
      {{ Form::label('name', 'Display Name: ') }}
      {{ Form::text('name') }}
      {{ $errors->first('name') }}
    </div>
    
    <div>
      {{ Form::label('sort', 'Sort Name: ') }}
      {{ Form::text('sort') }}
      {{ $errors->first('sort') }}
    </div>
    
    <div>
      {{ Form::submit('Create') }}
    </div>
  {{ Form::close() }}

@stop