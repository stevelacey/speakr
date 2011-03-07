$(function() {
  if($('article.event').length) {
    if($('article.event .location .street-address').length) {
      getGoogleMap();
    } else {
      $('section.location').append(
        $('<p/>', {text: 'Provide a street address and we\'ll render a map of the event and nearby POI.'})
      );
    }

    $('section.description').each(function () {
      var description = this
      $(description).css('padding-right', '60px');

      if($(description).find('form').length) {
        $(description).find('form').hide();

        $(description).find('.content').after(
          $('<button/>', {
            html: '<span class="action">Edit</span><span class="cancel">Cancel</span>',
            'class': 'edit'
          }).click(function() {
            var speed = 0;

            if($(this).hasClass('active')) {
              $(description).find('form').hide(speed, function() {
                $(description).find('.content').show(speed);
              });
              $(this).removeClass('active');
            } else {
              $(description).find('.content').hide(speed, function() {
                $(description).find('form')
                  .show(speed)
                  .find(':input:visible:first')
                  .focus();
              });
              $(this).addClass('active');
            }
        })).dblclick(function() {
            var speed = 0;

            if($(this).siblings('.edit').hasClass('active')) {
              $(description).find('form').hide(speed, function() {
                $(description).find('.content').show(speed);
              });
              $(this).siblings('.edit').removeClass('active');
            } else {
              $(description).find('.content').hide(speed, function() {
                $(description).find('form')
                  .show(speed)
                  .find(':input:visible:first')
                  .focus();
              });
              $(this).siblings('.edit').addClass('active');
            }
        });
      }
    });

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

  $('.content_search').each(function() {
    $(this).submit(contentSearchAction);
  });

  $('.user_search').each(function() {
    $(this).submit(userSearchAction);
  });
});

var map;
var gInfoWindow;
var response = [];

var poi = ['coffee', 'hotel', 'internet cafe'];

var icons = {
  'coffee': new google.maps.MarkerImage(
    "/images/map/coffee.png",
    new google.maps.Size(22, 22),
    new google.maps.Point(0, 0),
    new google.maps.Point(6, 20)
  ),
  'hotel': new google.maps.MarkerImage(
    "/images/map/hotel.png",
    new google.maps.Size(22, 22),
    new google.maps.Point(0, 0),
    new google.maps.Point(6, 20)
  ),
  'internet cafe': new google.maps.MarkerImage(
    "/images/map/wifi.png",
    new google.maps.Size(22, 22),
    new google.maps.Point(0, 0),
    new google.maps.Point(6, 20)
  )
};

var shadows = {
  'coffee': new google.maps.MarkerImage(
    "/images/map/coffee_s.png",
    new google.maps.Size(36,22),
    new google.maps.Point(0,0),
    new google.maps.Point(11,22)
  ),
  'hotel': new google.maps.MarkerImage(
    "/images/map/hotel_s.png",
    new google.maps.Size(36,22),
    new google.maps.Point(0,0),
    new google.maps.Point(11,22)
  ),
  'internet cafe': new google.maps.MarkerImage(
    "/images/map/wifi_s.png",
    new google.maps.Size(39,22),
    new google.maps.Point(0,0),
    new google.maps.Point(11,22)
  )
}

var contentSearchAction = function(event) {
  contentSearch($(this).find('input.query').val());
  event.preventDefault();
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
          "/images/map/event.png",
          new google.maps.Size(30,40),
          new google.maps.Point(0,0),
          new google.maps.Point(15,40)
        ),
        shadow: new google.maps.MarkerImage(
          "/images/map/event_s.png",
          new google.maps.Size(54,40),
          new google.maps.Point(0,0),
          new google.maps.Point(15,40)
        ),
        shape: {
          coord: [14,1,14,2,11,3,9,4,7,5,22,6,23,7,24,8,26,9,27,10,28,11,28,12,28,13,23,14,23,15,23,16,23,17,22,18,22,19,22,20,22,21,22,22,22,23,22,24,22,25,22,26,21,27,21,28,21,29,21,30,21,31,21,32,21,33,21,34,21,35,27,36,27,37,26,38,23,39,5,39,3,38,3,37,5,36,10,35,10,34,10,33,10,32,10,31,10,30,10,29,10,28,10,27,10,26,10,25,10,24,9,23,9,22,9,21,9,20,9,19,9,18,8,17,8,16,8,15,7,14,7,13,7,12,4,11,2,10,0,9,0,8,0,7,0,6,5,5,6,4,8,3,10,2,11,1,14,1],
          type: 'poly'
        },
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
    var list = $('<ul/>', {'class': 'users details extra'});
    
    $('.user_search').find('ul, a').remove();

    for(var i in users) {
      list.append($('.user-search-result-template').jqote(users[i]));
    }

    if(users.length) {
      $('.user_search').append(list);

      list.after($('<a/>', {text: 'Load more results from Twitter', href: '#'}).click(function(event) {
        $('.user_search').find('ul, a').remove();
        twitterUserSearch(query);
        event.preventDefault();
      }));
    } else {
      twitterUserSearch(query);
    }
  });
}

function twitterUserSearch(query) {
  $.getJSON('/user/twitter/search/' + query, {}, function(users) {
    var list = $('<ul/>', {'class': 'users details extra'});

    for(var i in users) {
      list.append($('.user-search-result-template').jqote(users[i]));
    }

    $('.user_search').append(list);
  });
}

function contentSearch(query) {
  $.getJSON('/content/search/' + query, {}, function(results) {
    var list = $('<ol/>');

    for(var i in results) {
      list.append($('.content-search-result-template').jqote(results[i]));
    }

     $('.content_search').each(function() {
      $(this).find('ol, a').remove();
      $(this).append(list);
     });
   });
 }

function searchCallback(poi) {
  if (response[poi].results) {
    for (var i in response[poi].results) {
      addMarker(poi, response[poi].results[i], icons[poi], shadows[poi]);
    }
  }
}

function addMarker(poi, data, icon, shadow) {
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(data.lat, data.lng),
    map: map,
    title: data.title,
    icon: icon,
    shadow: shadow,
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