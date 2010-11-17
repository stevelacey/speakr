<?php if(!$user->isAuthenticated()) : ?>
  <div class="welcome">
    <h1>Welcome to Speakr</h1>
    <?php echo link_to('Login with Twitter', 'login') ?>
  </div>
<?php endif ?>