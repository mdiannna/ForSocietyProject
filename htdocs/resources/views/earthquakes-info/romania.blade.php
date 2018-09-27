@extends('layout')

@section('content')

  
  <section class="home-section container">
 
  	<div>
	<h1>{{ $title }} </h1>
	@foreach($earthquakes as $earthquake) 
	
		<p>Data, ora: {{ $earthquake["time"]}}</p>
		<p>Long: {{ $earthquake["lon"]}}</p>
		<p>Lat: {{ $earthquake["lat"]}}</p>
		<p>Adancime: {{ $earthquake["depth"]}}km</p>
		<p>Magnitudine: {{ $earthquake["mag"]}}</p>
		@if(isset($earthquake["location"])) 
			<p>Locatie: {{ $earthquake["location"]}}</p>
		@endif
		<!-- <p>Tara: {{ $earthquake["flynn_region"]}}</p> -->
		<hr>

		<!-- <div id="map{{$loop->index}}"></div> -->
	@endforeach
	@if(count($earthquakes)>0)
		<div id="map"></div>
	@else
		<p>Nu a fost nici un cutremur recent.</p>
	@endif


</div>
</section>

 
 <script>
 	var markers = [];

 	function initMap() {
 		var bucharest = {lat: 44.439663, lng: 26.096306};

      	// for(var i=0; i<{{count($earthquakes)}}; i++) {
      	// for(var i=0; i<1; i++) {
      		// alert('map' + i);
      		// alert(document.getElementById('map' + i));
      		var i=0;
      		var map = new google.maps.Map(document.getElementById('map'), {
      			center: bucharest,
      			zoom: 12
      		});


      		@foreach($earthquakes as $earthquake)

      		var marker = new google.maps.Marker({
      			position: new google.maps.LatLng({{ $earthquake["lat"] }} , {{ $earthquake["lon"] }}),
      			map: map
      		});


      		addMarker(marker);

      		@endforeach

      		addMarker(bucharest);



      		var card = document.getElementById('pac-card');
      		var input = document.getElementById('pac-input');
      		var types = document.getElementById('type-selector');
      		var strictBounds = document.getElementById('strict-bounds-selector');

      		map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

      		var autocomplete = new google.maps.places.Autocomplete(input);

      		// Bind the map's bounds (viewport) property to the autocomplete object,
      		// so that the autocomplete requests use the current map bounds for the
      		// bounds option in the request.
      		autocomplete.bindTo('bounds', map);

      		var infowindow = new google.maps.InfoWindow();
      		var infowindowContent = document.getElementById('infowindow-content');
      		infowindow.setContent(infowindowContent);



      		var marker = new google.maps.Marker({
      			map: map,
      			anchorPoint: new google.maps.Point(0, -29)
      		});

      		autocomplete.addListener('place_changed', function() {
      			infowindow.close();
      			marker.setVisible(false);
      			var place = autocomplete.getPlace();
      			if (!place.geometry) {
      				// User entered the name of a Place that was not suggested and
      				// pressed the Enter key, or the Place Details request failed.
      				window.alert("No details available for input: '" + place.name + "'");
      				return;
      			}

      			// If the place has a geometry, then present it on a map.
      			if (place.geometry.viewport) {
      				map.fitBounds(place.geometry.viewport);
      			} else {
      				map.setCenter(place.geometry.location);
      				map.setZoom(17);  // Why 17? Because it looks good.
      			}
      			marker.setPosition(place.geometry.location);
      			marker.setVisible(true);

      			var address = '';
      			if (place.address_components) {
      				address = [
      				(place.address_components[0] && place.address_components[0].short_name || ''),
      				(place.address_components[1] && place.address_components[1].short_name || ''),
      				(place.address_components[2] && place.address_components[2].short_name || '')
      				].join(' ');
      			}

      			infowindowContent.children['place-icon'].src = place.icon;
      			infowindowContent.children['place-name'].textContent = place.name;
      			infowindowContent.children['place-address'].textContent = address;
      			infowindow.open(map, marker);
      		});

      		// Sets a listener on a radio button to change the filter type on Places
      		// Autocomplete.
      		function setupClickListener(id, types) {
      			var radioButton = document.getElementById(id);
      			radioButton.addEventListener('click', function() {
      				autocomplete.setTypes(types);
      			});
      		}

      		setupClickListener('changetype-all', []);
      		setupClickListener('changetype-address', ['address']);
      		setupClickListener('changetype-establishment', ['establishment']);
      		setupClickListener('changetype-geocode', ['geocode']);

      		document.getElementById('use-strict-bounds')
      		.addEventListener('click', function() {
      			console.log('Checkbox clicked! New state=' + this.checked);
      			autocomplete.setOptions({strictBounds: this.checked});
      		});

      	}

      	function addMarker(location){
      		var marker = new google.maps.Marker({
      			position: location,
      			map: map
      		});
      		markers.push(marker);

      		var markerLat = marker.position.lat();
      		var markerLng = marker.position.lng();

      		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      		$.ajax({
      			/* the route pointing to the post function */
      			url: '/save-alert-marker',
      			type: 'POST',
      			/* send the csrf-token and the input to the controller */
      			// data: {_token: CSRF_TOKEN, message:$(".getinfo").val()},
      			data: {
      				_token: CSRF_TOKEN, 
      				message: "hello marker",
      				lat: markerLat,
      				lng: markerLng,
      				details: $('#details').val(),
      				pin_type_id: 2
      			},
      			dataType: 'JSON',
      			/* remind that 'data' is the response of the AjaxController */
      			success: function (data) { 
      				$('#details').val("");
      			},
      			error: function (data) { 
      				$(".writeinfo").append(data.msg); 
      			}
      		}); 
      	}



    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuUyRkHWpdoe6MTege8frZbNco9cRNP1c&libraries=places&callback=initMap" async defer></script>

@endsection