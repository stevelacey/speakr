<article role="main">
  <h1><?php echo $user->getName() ?></h1>
  <img src="<?php echo $user->getImage() ?>"/>

  <?php if($user->getSpeaking()->count()) : ?>
    <h2>Speaking</h2>
    <?php include_partial('event/short_list', array('events' => $user->getSpeaking())) ?>
  <?php endif ?>

  <?php if($user->getAttending()->count()) : ?>
    <h2>Attending</h2>
    <?php include_partial('event/short_list', array('events' => $user->getAttending())) ?>
  <?php endif ?>

  <?php if($user->getWatching()->count()) : ?>
    <h2>Watching</h2>
    <?php include_partial('event/short_list', array('events' => $user->getWatching())) ?>
  <?php endif ?>

  <?php if($user->getSpeakers()->count()) : ?>
    <h2>Speaks with</h2>
    <?php include_partial('user/image_list', array('users' => $user->getSpeakers())) ?>
  <?php endif ?>

  <?php if($user->getPresentations()->count()) : ?>
    <h2>Presentations</h2>
    <?php include_partial('presentation/list', array('presentations' => $user->getPresentations())) ?>
  <?php endif ?>
</article>