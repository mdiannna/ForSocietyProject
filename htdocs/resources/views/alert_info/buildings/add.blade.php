@extends('layout')

@section('content')

<link href="{{ asset('css/style.css')}}" rel="stylesheet">

<section class="text-center section pt-4">
	<div>
		<h2>
			Add building info
		</h1>
		
		<form method="POST" action="{{route('alert-info.building.store')}}" class="form-inline">
			@csrf
			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2" name="address">Address</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="address">
			</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">lat</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="lat">
			</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">lng</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="lng">
			</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">year_built</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="year_built">
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">height_type</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="height_type">
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">nr_apartments</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="nr_apartments">
			</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">nr_people</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="nr_people">
			</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">surface</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="surface">
			</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">year_expertise</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="year_expertise">
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2">expert</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<input type="text" class="form-control" name="expert"><
			</div>
			</div>


			<div class="form-group">
				<label class="control-label col-sm-2 col-md-2 col-lg-2" name="details">details</label>
				 <div class="col-sm-10 col-md-10 col-lg-10"> 
				<textarea name="details"></textarea>
			</div>
			</div>

					<button type="submit" class="btn btn-default">Submit</button>

				</form>
		</section>

		@endsection