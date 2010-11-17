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
      <?php echo link_to('Speakr', '@homepage') ?>
      <?php if($sf_user->isAuthenticated()) : ?>
        logged in as: <?php echo link_to(image_tag($user->getIcon()).$user, 'profile', $user) ?>, <?php echo link_to('logout', 'logout') ?>
      <?php else : ?>
        <?php echo link_to('Login with Twitter', 'login') ?>
      <?php endif ?>
    </header>
    <?php echo $sf_content ?>
    <footer>
    </footer>
  </body>
</html>