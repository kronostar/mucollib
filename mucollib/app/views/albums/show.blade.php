@extends('layouts.default')
<!-- mucollib/app/views/albums/show.blade.php -->

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			{{ link_to("albums/{$album->id}/edit", $album->name, array('class' => 'btn btn-lg btn-link btn-block')) }}
			{{ $album->Artist() }}
		</div>
	</div>
@stop