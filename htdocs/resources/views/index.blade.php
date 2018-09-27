@extends('layout')

@section('banner')
<!-- Section: intro -->
  <section id="intro" class="intro">
    <div class="slogan">
      <h1>ForSocietyProject</h1>
      <p>A solution for <b>monitoring earthquakes <br>and reducing the seismic risk</b></p>
      <!-- <a href="/buildings-map/0" class="btn btn-skin scroll">Vezi harta</a> -->
	<a href="/alert-map" class="btn btn-danger btn-lg">Alert!</a>
      
    </div>
  </section>
@endsection

@section('content')

<div class="container pt-4 pb-4">
	<hr>
	<section class="section pt-3 pb-3">
		<h2 class="text-center">How to behave before an earthquake?</h2>
		<div class="embed-responsive embed-responsive-16by9">
  			<iframe class="embed-responsive-item" src="{{url('/video/earthquake1.mp4')}}" />
			</iframe>
		</div>
		<p>Credits to: Marius Dobre @ForSociety</p>
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
