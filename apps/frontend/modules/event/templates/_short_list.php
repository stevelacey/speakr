<ol class="events">
  <?php foreach($events as $event) : ?>
    <?php include_partial('event/short', array('event' => $event)) ?>
  <?php endforeach ?>
</ol>