@extends('layouts.default')

@section('content')
  @if ($albums->count())
    <div class=albumbar>
      @foreach ($albums as $album)
	<div class=albumrow>
	  <div class=albumcell>
	    {{ $album->Name }}
	  </div>
	</div>
      @endforeach
    </div>
  @else
    <p>Unfortunately there are no matching albums, perhaps you should create some?</p>
  @endif
@stop
