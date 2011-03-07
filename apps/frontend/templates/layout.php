<?php $user = $sf_user->getGuardUser() ?>
<!doctype html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <header>
      <?php echo link_to(image_tag('/images/speakr.png', array('alt' => 'Speakr')), '@homepage', array('class' => 'logo')) ?>
      <?php if($sf_user->isAuthenticated()) : ?>
        <?php echo link_to('New Event', 'new', array(), array('class' => 'new')) ?>
        <div class="user">
          logged in as: <?php echo link_to(image_tag($user->getIcon()).$user, 'profile', $user) ?>, <?php echo link_to('logout', 'logout') ?>
        </div>
      <?php else : ?>
        <?php include_partial('sfTwitterAuth/signin_button') ?>
      <?php endif ?>
    </header>
    <?php echo $sf_content ?>
    <footer>
    </footer>
  </body>
</html>