$(function() {
  if($('article.event').length) {
    getGoogleMap();
    getTwitterFeed();
  }

  $('.user_search').each(function() {
    $(this).find('input.query').keyup(function() {
      userSearch($(this).val());
    });
    $(this).submit(function() {
      userSearch($(this).find('input.query').val());
      event.preventDefault();
    });
  });
});

if(typeof(google) != 'undefined') {
  var map;
  var gInfoWindow;
  var response = [];

  var poi = ['coffee', 'hotel', 'internet cafe'];

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
}

function getGoogleMap() {
  $.getJSON(window.location + '/map.json', {}, function(data) {
    if(data.event.latitude && data.event.longitude) {

      $('<div/>', {'class': 'map'}).append($('<h3/>', {text: 'Map'})).append($('<div/>', {'class': 'canvas'})).appendTo('article');

      var centerCoord = new google.maps.LatLng(data.event.latitude, data.event.longitude);

      map = new google.maps.Map($('.map div').get(0), {
        zoom: 16,
        center: centerCoord,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data.event.latitude, data.event.longitude),
        map: map,
        title: data.event.title,
        icon: new google.maps.MarkerImage(
          "/images/map/marker.png",
          new google.maps.Size(40, 43),
          new google.maps.Point(0, 0),
          new google.maps.Point(6, 20)
        ),
        zIndex: 1
      });

      addMarkerListener(marker, new google.maps.InfoWindow({
        content: '<h3>' + data.event.title + '</h3>'
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

function getTwitterFeed() {
  if($('.hashtag').length) {
    $('<div/>', {'class': 'tweets'}).append($('<h3/>', {text: 'Tweets'})).appendTo('body');
    getTweets();
  }
}

function getTweets() {
  $.ajax({
    url: 'http://search.twitter.com/search.json?q=' + $('.hashtag').text() + '&rpp=10',
    dataType: 'jsonp',
    success: function(json) {
      var tweets = $('.tweets');
      
      if(json.results.length) {
        if(!tweets.find('ol').length) {
          tweets.append($('<ol/>')).find('p').fadeOut();
        }
        
        for(i in json.results) {
          var tweet = json.results[i];

          if(!$(tweets).find('ol li[rel="' + tweet.id + '"]').length) {
            var content = tweet.from_user + ': ' + tweet.text;
            tweets.find('ol').prepend($('<li/>', {text: content, rel: tweet.id}).fadeIn()).find('li:gt(9)').fadeOut();
          }
        }
      }
      
      if(!tweets.find('p').length && !tweets.find('ol').length) {
        tweets.append($('<p/>', {text: 'No Tweets Found'}));
      }

      setTimeout('getTweets()', 10000);
    },
    error: function() {
      setTimeout('getTweets()', 10000);
    }
  });
}

function userSearch(query) {
  $.getJSON('/user/search/' + query, {}, function(users) {
    var list = $('<ol/>');

    for(var i in users) {
      var user = users[i];
      var text = ' ' + user.name + ' (@' + user.username + ') ';
      list.append($('<li/>', {text: text})
        .prepend($('<img/>', {src: user.image, alt: text, title: text}))
        .append($('<a/>', {text: 'Add as speaker!', href: window.location + '/add/' + user.username}))
      );
    }

    $('.user_search').each(function() {
      $(this).find('ol').remove();
      $(this).append(list);
    })
  });
}

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
    shadow: new google.maps.MarkerImage(
      "http://labs.google.com/ridefinder/images/mm_20_shadow.png",
      new google.maps.Size(22, 20),
      new google.maps.Point(0, 0),
      new google.maps.Point(6, 20)
    ),
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