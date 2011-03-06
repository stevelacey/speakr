<section class="social">
  <?php
    echo link_to(sfConfig::get('app_tweet_text'), 'http://twitter.com/share', array(
      'query_string' => http_build_query(array(
        'text' => strtr(sfConfig::get('app_tweet_message'), array(
          '%event%' => $event,
          '%date%' => $event->getDate(),
          '%city%' => $event->getCity(),
          '%country%' => $event->getCountry()
        )),
        'url' => url_for('event', $event, true),
        'via' => 'speakrapp'
      )),
      'class' => 'tweet',
      'title' => sfConfig::get('app_tweet_text')
    ))
  ?>
  <?php
    echo link_to(sfConfig::get('app_share_text'), 'http://www.facebook.com/sharer.php', array(
      'query_string' => http_build_query(array(
        't' => strtr(sfConfig::get('app_share_message'), array(
          '%event%' => $event,
          '%date%' => $event->getDate(),
          '%city%' => $event->getCity(),
          '%country%' => $event->getCountry()
        )),
        'u' => url_for('event', $event, true)
      )),
      'class' => 'share',
      'title' => sfConfig::get('app_share_text')
    ))
  ?>
</section>