<div>
  <?php include_partial('nav') ?>
  <div class="events">
    <h2>Your Watching</h2>
    <?php include_partial('event/short_list', array('events' => $events)) ?>
  </div>
</div>