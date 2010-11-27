$(function(){
  if($('article.event').length) {
    var event = new Event($('h1:first').text());

    $.getJSON(window.location + '/map.json', {}, function(data) {
      if(data.status == 'OK') {

        event.latitude = data.results[0].geometry.location.lat;
        event.longitude = data.results[0].geometry.location.lng;

        var centerCoord = new google.maps.LatLng(event.latitude, event.longitude);

        var map = new google.maps.Map($('<div/>', {'id': 'map'}).appendTo('article').get(0), {
          zoom: 15,
          center: centerCoord,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(event.latitude, event.longitude),
          map: map,
          title: event.title
        });

        var infowindow = new google.maps.InfoWindow({
          content: '<h3>' + event.title + '</h3>'
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
      }
    });
  }
});