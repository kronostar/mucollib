@extends('layouts.default') 
<!-- mucollib/app/views/artists/index.blade.php -->

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<form action='artists/create'>
				{{ Form::submit('Add Artist',array('class' => 'btn btn-lg btn-primary btn-block')) }}
			</form>
			@if ($artists->count())
				@foreach ($artists as $artist)
					<div class="row">
						{{ link_to("artists/{$artist->id}",$artist->name) }}
					</div>
		      	@endforeach
		  	@else
		  		<p class="lead">Unfortunately there are no matching artists, perhaps you should create some?</p>
		  	@endif
		</div>
		
		<div class="col-xs-12 col-sm-6">
			<form action='albums/create'>
				{{ Form::submit('Add Album',array('class' => 'btn btn-lg btn-primary btn-block')) }}
			</form>
			@if ($albums->count())
		      		<?php $count = 0; ?>
		      		@foreach ($albums as $album)
						@if ($count == 0)
							<div class="row">
						@endif
	    					<div class="col-xs-12 col-sm-6">
	    						{{ link_to("albums/{$album->id}",$album->name) }}
	    					</div>
						@if (++$count == 3)
							</div>
						@endif
		      			<?php if ($count == 3) $count = 0; ?>
		      		@endforeach
					@if ($count != 0)
						</div>
					@endif
		  	@else
		    	<p class="lead">Unfortunately there are no matching albums, perhaps you should create some?</p>
		  	@endif
		</div>
	</div>
@stop
