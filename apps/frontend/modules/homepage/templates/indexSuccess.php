<?php if(!$sf_user->isAuthenticated()) : ?>
  <div class="welcome">
    <h1>Welcome to Speakr</h1>
    <?php echo link_to('Login with Twitter', 'login') ?>
  </div>
<?php else : ?>
  <div class="upcoming">
    <h2>Friends Events</h2>
    <?php include_partial('event/short_list', array('events' => $user->getFriendEvents())) ?>
  </div>
  <div class="upcoming">
    <h2>Your Schedule</h2>
    <?php include_partial('event/short_list', array('events' => $user->getAttending())) ?>
  </div>
<?php endif ?>
<div class="upcoming">
  <h2>Upcoming Events</h2>
  <?php include_partial('event/short_list', array('events' => $events)) ?>
</div>