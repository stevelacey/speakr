<div>
  <?php if(!$sf_user->isAuthenticated()) : ?>
    <div class="welcome">
      <h1>Welcome to Speakr</h1>
      <p>Find yourself missing out on awesome events in the web industry? No more!</p>
      <p>Speakr is here to help you keep track of the events your friends are attending, and where your favourite speakers are making an appearance.</p>
      <p>Organising an event? You might already be listed! If not, <?php echo link_to('sign in', 'login') ?>, and the add event button is at the top!</p>
      <p>Know of a cool event you want people to know about? Add it! Speakr is a community wiki, you make the content, and others can contribute.</p>
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

    <?php if(isset($empty) && $empty) : ?>
      <o>It doesn't look like you're planning to go to any events, perhaps you'd be interested in some of these upcoming ones?</p>
      <h3>Upcoming Events</h3>
    <?php endif ?>

    <?php include_partial('event/short_list', array('events' => $events)) ?>
  </div>
</div>