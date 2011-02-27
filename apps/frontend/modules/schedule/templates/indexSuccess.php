<div>
  <?php if(!$sf_user->isAuthenticated()) : ?>
    <div class="welcome">
      <h1>Welcome to Speakr</h1>
      <?php include_partial('sfTwitterAuth/signin_button') ?>
    </div>
  <?php endif ?>

  <?php if($sf_user->isAuthenticated()) : ?>
    <?php include_partial('nav') ?>
  <?php endif ?>

  <div>
    <?php if($sf_user->isAuthenticated()) : ?>
      <h2>Your Schedule</h2>
    <?php else : ?>
      <h2>Upcoming Events</h2>
    <?php endif ?>

    <?php include_partial('event/short_list', array('events' => $events)) ?>
  </div>
</div>