jQuery(document).ready(function($){

	$ = jQuery;

	var map;
	var lat = $('#map-canvas').data('lat');
	var lng = $('#map-canvas').data('lng');
	function initialize() {
		var mapOptions = {
			zoom: 15,
			center: new google.maps.LatLng(lat, lng),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map-canvas'),
			mapOptions);
	}
	google.maps.event.addDomListener(window, 'load', initialize);

});