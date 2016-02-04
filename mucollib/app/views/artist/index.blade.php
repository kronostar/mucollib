@extends('layouts.default')

@section('content')
  @if ($artists->count())
    <div class=artistbar>
      @foreach ($artists as $artist)
	<div class=artistrow>
	  <div class=artistcell>
	    {{ link_to("artist/{$artist->id}", $artist->Name) }}
	  </div>
	</div>
      @endforeach
    </div>
  @else
    <p>Unfortunately there are no matching artists, perhaps you should create some?</p>
  @endif

  @if ($albums->count())
    <div class=albumbar>
      <?php $count = 0; ?>
      @foreach ($albums as $album)
	@if ($count == 0)
	<div class=albumrow>
	@endif
	  <div class=albumcell>
	    {{ $album->Name }}
	  </div>
	@if (++$count == 3)
	</div>
	@endif
      <?php 
        if ($count == 3) $count = 0;
      ?>
      @endforeach
    </div>
  @else
    <p>Unfortunately there are no matching albums, perhaps you should create some?</p>
  @endif
@stop