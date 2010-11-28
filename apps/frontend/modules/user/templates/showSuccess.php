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