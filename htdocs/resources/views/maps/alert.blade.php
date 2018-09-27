@extends('layout')

@section('content')
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('css/map.css')}}" rel="stylesheet">


  <section class="home-section text-center">
    <div>
      <h1>
          Alert map - add your location
      </h1>

      <div class="row">
        <label class="checkbox-inline" style="color:red"><b><input type="checkbox" value="">Medical emergency</b></label>
        <label class="checkbox-inline"  style="color:blue"><b><input type="checkbox" value="">Blocked access</b></label>
        <label class="checkbox-inline"  style="color:green"><b><input type="checkbox" value="">Leakage of gas</b></label> 
        <label class="checkbox-inline"  style="color:orange"><b><input type="checkbox" value="">Fire</b></label> 

      </div>


      <div class="row form-group">

      <label for="details">Add a description</label>
      <br>
      <textarea class="form-input" name="details" id="details"></textarea>
            <!-- <div class="writeinfo">io</div>    -->
      </div>
        

      <button id="location" name="location" class="btn btn-danger">Add current location</button>
        <!-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> -->
      
      <div class="pac-card" id="pac-card">
      <div>
        <div id="title">
          Alert map - add your location
        </div>
        <div id="type-selector" class="pac-controls">
          <input type="radio" name="type" id="changetype-all" checked="checked">
          <label for="changetype-all">All</label>

          <input type="radio" name="type" id="changetype-establishment">
          <label for="changetype-establishment">Establishments</label>

          <input type="radio" name="type" id="changetype-address">
          <label for="changetype-address">Addresses</label>

          <input type="radio" name="type" id="changetype-geocode">
          <label for="changetype-geocode">Geocodes</label>
        </div>
        <div id="strict-bounds-selector" class="pac-controls">
          <input type="checkbox" id="use-strict-bounds" value="">
          <label for="use-strict-bounds">Strict Bounds</label>
        </div>
      </div>
      <div id="pac-container">
        <input id="pac-input" type="text"
            placeholder="Enter a location">
      </div>
    </div>
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>

    </div>
    @if(Session::has('message'))
    <div class="alert alert-{{ Session::get('message-type') }} alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <i class="glyphicon glyphicon-{{ Session::get('message-type') == 'success' ? 'ok' : 'remove'}}"></i> {{ Session::get('message') }}
    </div>
@endif
  </section>
  
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  

 <script>

      $('#location').click(function() {

         if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
       
     
            infoWindow.setPosition(pos);
            infoWindow.setContent('Locatia curenta');
            infoWindow.open(map);
            map.setCenter(pos);
                addMarker(pos);

          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        else {
          handleLocationError(false, infoWindow, map.getCenter());
        }

      });

      var markers = [];

      function initMap() {

        var bucharest = {lat: 44.439663, lng: 26.096306};

          map = new google.maps.Map(document.getElementById('map'), {
          center: bucharest,
          zoom: 12
        });

         map.addListener('click', function(event) {
          addMarker(event.latLng);
        });
  
     infoWindow = new google.maps.InfoWindow;
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Your curret location.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        else {
          handleLocationError(false, infoWindow, map.getCenter());
        }


        @foreach($markers as $marker)
         var contentString ='<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
              '<div id="bodyContent">'+ "<p>" + "{{$marker->details}}"+
            '</p></div></div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });


            var marker = new google.maps.Marker({
              position: new google.maps.LatLng({{ $marker->lat }} , {{ $marker->lng }}),
              map: map,
              title: "detalii: {{$marker->details}}"
            });

             marker.addListener('mouseover', function() {
          infowindow.open(map, marker);
        });
             marker.addListener('click', function() {
              console.log(contentString);
          infowindow.open(map, marker);
        });

        @endforeach

    // var marker = new google.maps.Marker({
    //   position: location,
    //   map: map,
    //   icon:image
    // });

        // addMarker(bucharest);

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
          addMarker(place.geometry.location);


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
          var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

    var marker = new google.maps.Marker({
      position: location,
      map: map,
      icon:image,
      title: $('#details').val()
    });
    markers.push(marker);
    // alert(marker);
    // alert(marker.position);
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
            pin_type_id: 1
          },
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) { 
              $(".writeinfo").append(data.msg); 
               alert('Alerta adaugata pe harta\n' + "Descriere: " +$('#details').val());

               $('#details').val("");
          },
          error: function (data) { 
              $(".writeinfo").append(data.msg); 
          }
      }); 

    return marker;
  }
  
  function setMapOnAll(map){
    for(var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

  function clearMarkers() {
    setMapOnAll(null);
  }

  function showMarkers(){
    setMapOnAll(map);
  }

  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }


function handleLocationEror(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed' : 'Error: Your browser doesn\'t support geolocation');
    infoWindow.open(map);
  }
    </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuUyRkHWpdoe6MTege8frZbNco9cRNP1c&libraries=places&callback=initMap" async defer></script>



@endsection