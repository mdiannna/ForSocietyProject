@extends('layout')

@section('banner')
<!-- Section: intro -->
  <section id="intro" class="intro">
    <div class="slogan">
      <h1>ForSocietyProject</h1>
      <p>A solution for <b>monitoring earthquakes <br>and reducing the seismic risk</b></p>
      <!-- <a href="/buildings-map/0" class="btn btn-skin scroll">Vezi harta</a> -->
	<a href="{{route('alert-map')}}" class="btn btn-danger btn-lg">Alert! I am affected by the earthquake!</a>
      
    </div>
  </section>
@endsection

@section('content')

<div class="container pt-4 pb-4">
	<section class="section pt-3 pb-3">
		<div class="text-center">
			<h1 class="text-center">Pre-Eearthquake</h1>
			<h4 class="text-success"><strong>How to prepare before an earthquake?</strong></h4>
			<p class="pt-3">There are some simple rules that you can follow to prepare for the earthquake. Watch the video to see them</p>
		<a href="{{route('before-earthquake')}}" class="btn btn-success btn-lg">Watch video</a>

		</div>
	</section>

	<hr>

	<section class="section pt-3 pb-3 text-center">
		<h1 class="text-center">Mid-Earthquake</h1>
		<h4 class="text-warning text-center"><strong>Sensors on buildings - collect data and send to intervention teams</strong></h4>
		<p class="pt-3">We use Arduino boards, gyroscope sensors and Wi-Fi modules to collect data about buildings during an earthquake and notify the intervention teams and authorities about the damaged or even collapsed buildings.</p>
		
		<a href="{{route('hardware.about')}}" class="btn btn-warning btn-lg">View more details about hardware</a>
		
	</section>

	<hr>

	<section class="section pt-3 pb-3">
		<h1 class="text-center">After Earthquake</h1>
		<div class="pt-3 pb-3 text-center">
			<h4 class="text-danger"><strong>Alert map - send your location and problem to intervention teams</strong></h4>
			<a href="{{route('alert-map')}}" class="btn btn-danger btn-lg">Alert! I am affected by the earthquake!</a>
		</div>
		<br>

		<div class="pt-3 pb-3 text-center">
			<h4 class="text-info"><strong>Using AI to prioritize alerts for intervention teams </strong></h4>
			<p>We use IBM Natural Language Understanding to prioritize alerts for intervention teams based on sentiment and emotion analysis, tracking mostly the negative sentiment and emotions of fear during the earthquake </p>
			<a href="{{route('alert-info')}}" class="btn btn-info text-center"> View alerts</a>
		</div>

		<div class="pt-3 pb-3 text-center">
			<h4 class="text-primary"><strong>Intelligent Assistant to ease communication and determine needs</strong></h4>
			<p>IBM Watson Conversation AI provides a more natural way for people affected by the earthquake to send their needs to the intervention teams</p>
			<!-- <a href="/watson-chat" class="btn btn-primary text-center"> Start chat</a> -->
			<a href="/" class="btn btn-primary text-center"> Start chat</a>
		</div>

		<div class="pt-3 pb-3 text-center">
			<h4 class="text-warning"><strong>Tracking the most recent earthquakes</strong></h4>
			<p>See a list of the most recent earthquakes in Romania and worldwide:</p>
			<p>Source: <i>http://www.seismicportal.eu</i></p>
			<div class="row text-center">
				<!-- <div class="col-md-6 md-offset-3"> -->
					<div class="col-md-3 offset-md-3 pt-1 pb-1">
						<a href="{{route('earthquakes.all')}}" class="btn btn-warning text-center"> Recent earthquakes worldwide</a>
					</div>
					<div class="col-md-3 pt-1 pb-1">
						<a href="{{route('earthquakes.romania')}}" class="btn btn-warning text-center"> Recent earthquakes in Romania</a>
					</div>
				</div>				
			<!-- </div> -->
		</div>
		
	</section>

</div>


<style type="text/css">
	.intro {
	width:100%;
	position:relative;
}

#intro{	
	background-image: url(../img/home.jpeg);
	background-size: cover;
}

.intro .slogan {
	padding:250px 0 60px;
	text-align: center;
	
}
.intro .slogan h1 {
	color: #fff;
	line-height: 1.1em;
	margin-bottom: 20px;
	 font-size: 40px;
}
.intro .slogan p {
	color: #eee;
	margin-bottom: 50px;
	font-size: 20px;
}
</style>
@endsection
