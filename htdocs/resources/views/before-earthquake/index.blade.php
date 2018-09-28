@extends('layout')

@section('content')

<div class="container pt-4 pb-4">
	<section class="section pt-3 pb-3">
		<div class="text-center">
			<h1 class="text-center">Pre-Eearthquake</h1>
			<h4 class="text-success"><strong>How to prepare before an earthquake?</strong></h4>
			<p class="pt-3">There are some simple rules that you can follow to prepare for the earthquake. Watch the video to see them</p>
			<div class="embed-responsive embed-responsive-16by9">
	  			<iframe class="embed-responsive-item" src="{{url('/video/earthquake1.mp4')}}" />
				</iframe>
			</div>
		</div>
		<div class="pt-3">
			<p>Author: Dobre Marius @ForS0ciety</p>
			<p><small>Music: https://www.bensound.com</small></p>
		</div>
	</section>

</div>

</style>
@endsection
