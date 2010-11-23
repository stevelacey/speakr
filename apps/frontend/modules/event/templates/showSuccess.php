<h1><?php echo $event ?></h1>
<h2><?php echo $event->getTagline() ?></h2>

<?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

<?php if($sf_user->isAuthenticated()) : ?>
  <?php if(!$attending) : ?>
    <?php echo link_to('Attend', 'event_action', array('sf_subject' => $event, 'action' => 'attend', 'verb' => 'do')) ?>
  <?php else : ?>
    <?php echo link_to('Stop Attending', 'event_action', array('sf_subject' => $event, 'action' => 'attend', 'verb' => 'dont')) ?>
  <?php endif ?>

  <?php if(!$watching) : ?>
    <?php echo link_to('Watch', 'event_action', array('sf_subject' => $event, 'action' => 'watch', 'verb' => 'do')) ?>
  <?php else : ?>
    <?php echo link_to('Stop Watching', 'event_action', array('sf_subject' => $event, 'action' => 'watch', 'verb' => 'dont')) ?>
  <?php endif ?>
<?php endif ?>

<div>
  <img src="http://logo.stevelacey.net/<?php echo $event->getWebsite() ?>"/>
</div>

<p><?php echo $event->getDescription() ?></p>

<p>
  <?php echo $event->getAddress() ?><br/>
  <?php echo $event->getPostcode() ?>
</p>

<a href="<?php echo $event->getWebsite() ?>">Visit Website</a>
<p>#<?php echo $event->getHashtag() ?></p>

<h3>Speakers</h3>

<?php foreach($event->getSpeakers() as $speaker) : ?>
  <?php echo link_to(image_tag($speaker->getIcon()), 'profile', $speaker) ?>
<?php endforeach ?>

<h3>Attending</h3>

<?php foreach($event->getAttending() as $attendee) : ?>
  <?php echo link_to(image_tag($attendee->getIcon()), 'profile', $attendee) ?>
<?php endforeach ?>