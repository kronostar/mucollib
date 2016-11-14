@extends('layouts.default')
<!-- mucollib/app/views/albums/show.blade.php -->

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="row">
				{{ link_to("albums/{$album->id}/edit", $album->name, array('class' => 'btn btn-lg btn-link btn-block')) }}
			</div>
			<div class="row">
				<b>Artist:</b> {{ $album->artist->name }}
			</div>
			<div class="row">
				<b>Released:</b> {{ $album->year }}
			</div>
			<div class="row">
				<b>First Released:</b> {{ $album->origyear }}
			</div>
			<div class="row">
				<b>Catalogue Number:</b> {{ $album->catno}}
			</div>
			<div class="row">
				<b>Original Catalogue Number:</b> {{ $album->origcatno }}
			</div>
			<div class="row">
				<b>Label:</b> {{ $album->label->name }}
			</div>
			<div class="row">
				<b>Original Label:</b> {{ App\Label::where('id', '=', $album->origlabel_id)->first()->name }}
			</div>
			<div class="row">
				<b>Format:</b> {{ $album->format->name }}
			</div>
			<div class="row">
				<b>Genre:</b> {{ $album->genre->name }}
			</div>
		</div>
	</div>
@endsection
