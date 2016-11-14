@extends('layouts.default')
<!-- mucollib/app/views/artists/edit.blade.php -->

@section('content')

  {{ Form::model($artist, array('route' => array('artists.update', $artist->id), 'method' => 'put','class' => 'form-artist')) }}
    <h1>Edit Artist</h1>
    {{ Form::hidden('id', $artist->id) }}
    <div class='divTable'>
      <div class='divTableBody'>
        <div class='divTableRow'>
          <div class='divTableCell'>
            {{ Form::label('name', 'Name:') }}
          </div>
          <div class='divTableCell'>
            {{ Form::text('name', $artist->name, array('class' => 'form-control')) }}
            {{ $errors->first('name') }}
          </div>
        </div>
        <div class='divTableRow'>
          <div class='divTableCell'>
            {{ Form::label('sort', 'Sort:') }}
          </div>
          <div class='divTableCell'>
            {{ Form::text('sort', $artist->sort, array('class' => 'form-control')) }}
            {{ $errors->first('sort') }}
          <div>
        </div>
      </div>
    </div>
    {{ Form::submit('Update',array('class' => 'btn btn-lg btn-primary btn-block')) }}
  {{ Form::close() }}

@endsection