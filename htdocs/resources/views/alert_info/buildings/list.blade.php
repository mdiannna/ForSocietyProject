@extends('layout')

@section('content')

<link href="{{ asset('css/style.css')}}" rel="stylesheet">

<section class="text-center section pt-4">
	<div>
		<h2>
			View building info
		</h1>
		<table class="table table-hover">
		  <thead class="thead-dark">

		  	 

		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Address</th>
		      <th scope="col">Lat</th>
		      <th scope="col">Lng</th>
		      <th scope="col">Year built</th>
		      <th scope="col">Risk class</th>
		      <th scope="col">Height type</th>
		      <th scope="col">Nr of apartments</th>
		      <th scope="col">Nr of people living</th>
		      <th scope="col">Surface</th>
		      <th scope="col">Year last expertise</th>
		      <th scope="col">Expert</th>
		      <th scope="col">Details</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($buildings as $building)
		  		
		      <th scope="row">{{$loop->index }}</th>
		      <td>{{ $building->address }}</td>
		      <td>{{ $building->lat }}</td>
		      <td>{{ $building->lng }}</td>
		      <td>{{ $building->year_built}}</td>
		      <td>{{ $building->height_type }}</td>
		      <td>{{ $building->nr_apartments}}</td>
		      <td>{{ $building->nr_people }}</td>
		      <td>{{ $building->surface }}</td>
		      <td>{{ $building->year_expertise }}</td>
		      <td>{{ $building->expert }}</td>
		      <td>{{ $building->details }}</td>
		    </tr>
		   	@endforeach
		</table>

	</div>
</section>

@endsection