src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=visualization">

var map;

function initialize() {
  var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(2.8,-187.3),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };
  map = new google.maps.Map(document.getElementById('map_canvas'),
        mapOptions);

  var script = document.createElement('script');
  script.src = 'http://earthquake.usgs.gov/earthquakes/feed/geojsonp/2.5/week';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(script, s);
  
}

// Loop through the results array and place a marker for each
// set of coordinates.
window.eqfeed_callback = function(results) {
  for (var i = 0; i < results.features.length; i++) {
    var coords = results.features[i].geometry.coordinates;
    var latLng = new google.maps.LatLng(coords[1],coords[0]);
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      icon: getCircle(earthquake.properties.mag)
      
    });
  }
}