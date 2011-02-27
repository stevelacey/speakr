<div>
  <?php if(!$sf_user->isAuthenticated()) : ?>
    <div class="welcome">
      <h1>Welcome to Speakr</h1>
      <?php include_partial('sfTwitterAuth/signin_button') ?>
    </div>
    <div class="events">
      <h2>Upcoming Events</h2>
      <?php include_partial('event/short_list', array('events' => $events)) ?>
    </div>
  <?php else : ?>
    <?php include_partial('nav') ?>
    <div class="events">
      <h2>Your Schedule</h2>
      <?php include_partial('event/short_list', array('events' => $events)) ?>
    </div>
  <?php endif ?>
</div>