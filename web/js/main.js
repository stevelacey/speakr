var gInfoWindow;
var map;

var icons = {
  'coffee': new google.maps.MarkerImage(
    "http://labs.google.com/ridefinder/images/mm_20_brown.png",
    new google.maps.Size(12, 20),
    new google.maps.Point(0, 0),
    new google.maps.Point(6, 20)
  ),
  'hotel': new google.maps.MarkerImage(
    "http://labs.google.com/ridefinder/images/mm_20_red.png",
    new google.maps.Size(12, 20),
    new google.maps.Point(0, 0),
    new google.maps.Point(6, 20)
  ),
  'internet cafe': new google.maps.MarkerImage(
    "http://labs.google.com/ridefinder/images/mm_20_gray.png",
    new google.maps.Size(12, 20),
    new google.maps.Point(0, 0),
    new google.maps.Point(6, 20)
  )
};

var gSmallShadow = new google.maps.MarkerImage(
  "http://labs.google.com/ridefinder/images/mm_20_shadow.png",
  new google.maps.Size(22, 20),
  new google.maps.Point(0, 0),
  new google.maps.Point(6, 20)
);

var poi = ['coffee', 'hotel', 'internet cafe'];
var response = [];
      
$(function() {
  if($('article.event').length) {
    $.getJSON(window.location + '/map.json', {}, function(data) {
      event = data.event;

      if(event.latitude && event.longitude) {
        var centerCoord = new google.maps.LatLng(event.latitude, event.longitude);

        map = new google.maps.Map($('<div/>', {'id': 'map'}).appendTo('article').get(0), {
          zoom: 16,
          center: centerCoord,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(event.latitude, event.longitude),
          map: map,
          title: event.title,
          icon: new google.maps.MarkerImage(
            "/images/map/marker.png",
            new google.maps.Size(40, 43),
            new google.maps.Point(0, 0),
            new google.maps.Point(6, 20)
          ),
          zIndex: 1
        });

        addMarkerListener(marker, new google.maps.InfoWindow({
          content: '<h3>' + event.title + '</h3>'
        }));

        for(var i in poi) {
          var search = new GlocalSearch();
          response[poi[i]] = search;
          search.setCenterPoint(map.getCenter());
          search.setSearchCompleteCallback(null, searchCallback, [poi[i]]);
          search.execute(poi[i]);
        }
      }
    });
  }
});

function searchCallback(poi) {
  if (response[poi].results) {
    for (var i in response[poi].results) {
      addMarker(poi, response[poi].results[i], icons[poi]);
    }
  }
}

function addMarker(poi, data, icon) {
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(data.lat, data.lng),
    map: map,
    title: data.title,
    icon: icon,
    shadow: gSmallShadow,
    zIndex: 0
  });

  var info = $('<div/>');

  info.append($('<a/>', {text: data.titleNoFormatting, href: data.url}));
  info.append($('<p/>', {text: data.streetAddress}));

  if(poi == 'hotel') {
    info.append($('<p/>', {text: data.phoneNumbers[0].number}));
  }

  var infowindow = new google.maps.InfoWindow({
    content: info.html()
  });

  addMarkerListener(marker, infowindow);
}

function addMarkerListener(marker, infowindow) {
  google.maps.event.addListener(marker, 'click', function() {
    if(gInfoWindow) gInfoWindow.close();
    gInfoWindow = infowindow;
    infowindow.open(map, marker);
  });
}