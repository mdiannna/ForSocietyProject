@extends('layout')

@section('content')

<div class="container pt-4 pb-4">
	
	<section class="section pt-3 pb-3 text-center">
		<h1 class="text-center">Mid-Earthquake</h1>
		<h4 class="text-warning text-center"><strong>Sensors on buildings - collect data and send to intervention teams</strong></h4>
		<p class="pt-3">We use Arduino boards, gyroscope sensors and Wi-Fi modules to collect data about buildings during an earthquake and notify the intervention teams and authorities about the damaged or even collapsed buildings.</p>
		
		<div class="embed-responsive embed-responsive-16by9">
  			<iframe class="embed-responsive-item" src="{{url('/video/hardware-overview.mp4')}}" />
			</iframe>
		</div>
		
	</section>


</div>

@endsection
