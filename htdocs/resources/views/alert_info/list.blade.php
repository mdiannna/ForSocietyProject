@extends('layout')

@section('content')

<link href="{{ asset('css/style.css')}}" rel="stylesheet">

<section class="text-center section">
	<div>
		<h2>
			View alerts
		</h1>
		<table class="table table-hover">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Address</th>
		      <th scope="col">Details</th>
		      <th scope="col">Type</th>
		      <th scope="col">Sentiment</th>
		      <th scope="col">Emotions coefficient</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($pins as $pin)
		  		@if($pin->emotions_coefficient > 0.6)
		    		<tr class="table-danger">
		    	@elseif($pin->emotions_coefficient > 0.3)
		    		<tr class="table-warning">
		    	@else 
		    		<tr class="table-active">
		    	@endif
		      <th scope="row">{{$loop->index }}</th>
		      <td>{{ $pin->address }}</td>
		      <td>{{ $pin->details }}</td>

		      <td>
		      	@if($pin->pin_type_id==2)
		      		Medical
		      	@elseif($pin->pin_type_id==3)
		      		Blocked access
		      	@elseif($pin->pin_type_id==4)
		      		Leakage of gas
		      	@elseif($pin->pin_type_id==5)
		      		Fire
		      	@else
		      		Other
		      	@endif
		      	</td>
		      <td>{{ $pin->sentiment }}</td>
		      <td>{{ $pin->emotions_coefficient }}</td>
		      <td><a href="{{route('alert-map')}}" class="btn btn-dark">View on map</a></td>
		    </tr>
		   	@endforeach
		</table>

	</div>
</section>

@endsection