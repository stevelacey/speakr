$(function() {
  if($('article.event').length) {
    if($('article.event .location .street-address').length) {
      getGoogleMap();
    }

    $('section.location').each(function () {
      var location = this

      if($(location).find('form').length) {
        $(location).find('form').hide();

        $(location).find('h2').after(
          $('<button/>', {
            html: '<span class="action">Edit</span><span class="cancel">Cancel</span>',
            'class': 'edit'
          }).click(function() {
            var speed = 150;

            if($(this).hasClass('active')) {
              $(location).find('form').slideUp(speed, function() {
                $(location).find('span.location').slideDown(speed);
              });
              $(this).removeClass('active');
            } else {
              $(location).find('span.location').slideUp(speed, function() {
                $(location).find('form')
                  .slideDown(speed)
                  .find(':input:visible:first')
                  .focus();
              });
              $(this).addClass('active');
            }
        }));
      }
    });
    
    if($('.twitter .hashtag').length) {
      getTweets();
    }
  }

  getLocation();

  $('.user_search').each(function() {
    $(this).submit(userSearchAction);
  });
});

if(typeof(google.maps) != 'undefined') {
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

var userSearchAction = function(event) {
  localUserSearch($(this).find('input.query').val());
  event.preventDefault();
}

var twitterSearchAction = function(event) {
  twitterUserSearch($(this).find('input.query').val());
  event.preventDefault();
}

function getGoogleMap() {
  $.getJSON(window.location + '/map.json', {}, function(data) {
    if(data.event.latitude && data.event.longitude) {

      $('<section/>', {'class': 'map'}).append($('<h3/>', {text: 'Map'})).append($('<div/>', {'class': 'canvas'})).appendTo('section.location');

      var centerCoord = new google.maps.LatLng(data.event.latitude, data.event.longitude);

      map = new google.maps.Map($('.map div').get(0), {
        zoom: 16,
        center: centerCoord,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data.event.latitude, data.event.longitude),
        map: map,
        name: data.event.name,
        icon: new google.maps.MarkerImage(
          "/images/map/marker.png",
          new google.maps.Size(40, 43),
          new google.maps.Point(0, 0),
          new google.maps.Point(6, 20)
        ),
        zIndex: 1
      });

      addMarkerListener(marker, new google.maps.InfoWindow({
        content: '<h3>' + data.event.name + '</h3>'
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

function getLocation() {
  $("#event_location, #conference_event_location").autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: 'http://query.yahooapis.com/v1/public/yql?q=select * from geo.places where text = "' + request.term + '" and placetype = 7&format=json',
        dataType: 'jsonp',
        delay: 100,
        success: function(data) {
          var places = data.query.results.place;
          response($.map($.isArray(places) ? places : [places], function(item) {
            return {
              label: item.name + ', ' + item.admin1.content + ', ' + item.country.content,
              value: item.woeid
            }
          }));
        }
      });
    },
    select: function(event, ui) {
      $('#event_city_id, #conference_event_city_id').val(ui.item.value);
      $(this).val(ui.item.label);
      event.preventDefault();
    },
    focus: function(event, ui) {
      event.preventDefault();
    }
  }).change(function() {
    $('#event_city_id, #conference_event_city_id').val(null);
  });
}

function getTweets() {
  $.ajax({
    url: 'http://search.twitter.com/search.json?q=' + $('.twitter .hashtag').text() + '&rpp=10',
    dataType: 'jsonp',
    success: function(json) {
      var tweets = $('.twitter');
      
      if(json.results.length) {
        if(!tweets.find('ol').length) {
          tweets.find('h2').text('Tweets #' + $('.twitter .hashtag').text());
          
          if(tweets.find('form').length) {
            tweets.find('h2').after(
              $('<button/>', {
                html: '<span class="action">Edit</span><span class="cancel">Cancel</span>',
                'class': 'edit'
              }).click(function() {
                var speed = 150;

                if($(this).hasClass('active')) {
                  $(tweets).find('form')
                    .slideUp(speed);
                  $(this).removeClass('active');
                } else {
                  $(tweets).find('form')
                    .slideDown(speed)
                    .find(':input:visible:first')
                    .focus();
                  $(this).addClass('active');
                }
              })
            );
          }
          
          tweets
            .find('p').remove().end()
            .find('form').hide().end()
            .append($('<ol/>'));
        }

        var template = '{1}<br/><small>from <a href="http://twitter.com/{2}">{2}</a> <a href="http://twitter.com/{2}/statuses/{0}">{3}</a></small>';
        
        for(i in json.results) {
          var tweet = json.results[i];

          if(!$(tweets).find('ol li[rel="' + tweet.id + '"]').length) {
            tweets.find('ol').append(
              $('<li/>', {
                html: template.format(
                  tweet.id_str,
                  tweet.text.parseTweet(),
                  tweet.from_user,
                  $.timeago(dateFormat(tweet.created_at, "isoUtcDateTime"))
                ),
                rel: tweet.id
              }).fadeIn()
            ).find('li:gt(9)').fadeOut();
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

function localUserSearch(query) {
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

    if(users.length) {
      list.append($('<a/>', {text: 'Try Twitter?', href: '#'}).click(function(event) {
        $('.user_search').unbind('submit', userSearchAction).submit(twitterSearchAction).find('ol, a').remove();
        twitterUserSearch(query);
        event.preventDefault();
      }));
    } else {
      $('.user_search').unbind('submit', userSearchAction).submit(twitterSearchAction).find('ol, a').remove();
      twitterUserSearch(query);
    }

    $('.user_search').each(function() {
      $(this).find('ol, a').remove();
      $(this).append(list);
    });
  });
}

function twitterUserSearch(query) {
  $.getJSON('/user/twitter/search/' + query, {}, function(users) {
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
    });
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

/* Tweet String Parsers */

String.prototype.parseTweet = function () {
	return this.parseURL().parseUsername().parseHashtag();
};

String.prototype.parseURL = function () {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/g, function (url) {
		return url.link(url);
	});
};

String.prototype.parseUsername = function () {
	return this.replace(/[@]+[A-Za-z0-9-_]+/g, function (u) {
		var username = u.replace("@", "")
		return u.link("http://twitter.com/" + username);
	});
};

String.prototype.parseHashtag = function () {
	return this.replace(/[#]+[A-Za-z0-9-_]+/g, function (t) {
		var tag = t.replace("#", "%23")
		return t.link("http://search.twitter.com/search?q=" + tag);
	});
};

String.prototype.format = function () {
	var s = this,
        i = arguments.length;
	while (i--) {
		s = s.replace(new RegExp('\\{' + i + '\\}', 'gm'), arguments[i]);
	}
	return s;
};