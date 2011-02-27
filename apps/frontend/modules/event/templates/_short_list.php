<ol class="events">
  <?php foreach($events as $event) : ?>
    <?php include_partial('event/short', array('event' => $event, 'location' => !isset($location) || (isset($location) && $location))) ?>
  <?php endforeach ?>
</ol>