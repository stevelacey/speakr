<div>
  <h1><?php echo link_to($event, 'event', $event) ?></h1>
  <h2><?php echo $event->getTagline() ?></h2>

  <?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

  <div>
    <img src="http://logo.stevelacey.net/<?php echo $event->getWebsite() ?>"/>
  </div>

  <h2>Add User</h2>
  <?php include_partial('user/search') ?>

  <h3>Speakers</h3>
  <?php if($event->getSpeakers()->count()) : ?>
    <ul class="users details">
      <?php foreach($event->getSpeakers() as $speaker) : ?>
        <li>
          <?php include_partial('user/image_link', array('user' => $speaker)) ?>
          <?php echo link_to('Remove as speaker!', 'event_speaker_remove', array('sf_subject' => $event, 'username' => $speaker->getUsername()), array('method' => 'post')) ?>
        </li>
      <?php endforeach ?>
    </ul>
  <?php elseif($sf_user->isAuthenticated()) : ?>
    <p>None listed.</p>
  <?php endif ?>
</div>