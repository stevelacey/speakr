<div class="schedule">
  <?php include_partial('nav') ?>
  <div class="events">
    <h2>Friends Events</h2>
    <?php if($events->count()) : ?>
      <?php include_partial('event/short_list', array('events' => $events)) ?>
    <?php else : ?>
      <p>It doesn't look like anyone you follow is attending any events on Speakr, why not check out <?php echo link_to('upcoming events', 'upcoming_events') ?>?</p>
    <?php endif ?>
  </div>
</div>