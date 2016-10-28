@extends('layouts.default')
<!-- mucollib/app/views/albums/show.blade.php -->

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="row">
				{{ link_to("albums/{$album->id}/edit", $album->name, array('class' => 'btn btn-lg btn-link btn-block')) }}
			</div>
			<div class="row">
				<b>Artist:</b> {{ $album->Artists()->first()->name }}
			</div>
			<div class="row">
				<b>Released:</b> {{ $album->year }}
			</div>
			<div class="row">
				<b>Catalogue Number:</b> {{ $album->catno}}
			</div>
			<div class="row">
				<b>Label:</b> {{ $album->Labels()->first()->name }}
			</div>
			<div class="row">
				<b>First Released</b> {{ $album->origyear }}
			</div>
			<div class="row">
				<b>Original Catalogue Number:</b> {{ $album->origcatno }}
			</div>
			<div class="row">
				<b>Original Label:</b> {{ Labels::where('id', '=', $album->origlabels_id)->first()->name }}
			</div>
			<div class="row">
				<b>Format:</b> {{ $album->Formats()->first()->name }}
			</div>
			<div class="row">
				<b>Genre:</b> {{ $album->Genres()->first()->name }}
			</div>
		</div>
	</div>
@stop