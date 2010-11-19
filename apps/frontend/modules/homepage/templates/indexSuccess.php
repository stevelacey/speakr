<?php if(!$user->isAuthenticated()) : ?>
  <div class="welcome">
    <h1>Welcome to Speakr</h1>
    <?php echo link_to('Login with Twitter', 'login') ?>
  </div>
<?php endif ?>
<div class="upcoming">
  <h2>Upcoming Events</h2>
  <?php foreach($events as $event) : ?>
    <h3><?php echo link_to($event, 'event', $event) ?></h3>
    <p><?php echo $event->getDescription() ?></p>
  <?php endforeach ?>
</div>