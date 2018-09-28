var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 12,
		center: new google.maps.LatLng(44.439663, 26.096306),
		mapTypeId: 'terrain'
	});

	var script = document.createElement('script');
	script.src = 'http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp'; // LINK CATRE JSON
	document.getElementsByTagName('head')[0].appendChild(script); // luam din JSON head-ul
}

window.eqfeed_callback = function(results) {
	for(var i = 0; i < results.features.length; i++) {
		var coords = results.features[i].geometry.coordinates;
		var latLng = new google.maps.LatLng(coords[1], coords[0]);
		var marker = new google.maps.Marker({
			position: latLng,
			map: map
		});
	}
}
