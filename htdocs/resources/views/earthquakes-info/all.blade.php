@extends('layout')

@section('content')

  
  <section class="home-section container">
 
  	<div>
	<h1>{{ $title }} </h1>
	@foreach($earthquakes as $earthquake) 
	
		<p>Date, time: {{ $earthquake["time"]}}</p>
		<p>Long: {{ $earthquake["lon"]}}</p>
		<p>Lat: {{ $earthquake["lat"]}}</p>
		<p>Depth: {{ $earthquake["depth"]}}km</p>
		<p>Magnitude: {{ $earthquake["mag"]}}</p>
		@if(isset($earthquake["location"])) 
			<p>Location: {{ $earthquake["location"]}}</p>
		@endif
		<p>Region: {{ $earthquake["flynn_region"]}}</p>
		<hr>

		<!-- <div id="map{{$loop->index}}"></div> -->
	@endforeach
	@if(count($earthquakes)>0)
		<div id="map"></div>
	@else
		<p>No recent earthquake data available.</p>
	@endif


</div>
</section>


@endsection