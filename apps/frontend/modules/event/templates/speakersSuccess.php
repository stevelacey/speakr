<h1><?php echo link_to($event, 'event', $event) ?></h1>
<h2><?php echo $event->getTagline() ?></h2>

<?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

<div>
  <img src="http://logo.stevelacey.net/<?php echo $event->getWebsite() ?>"/>
</div>

<?php include_partial('user/search') ?>

<h3>Speakers</h3>
<?php if($event->getSpeakers()->count()) : ?>
  <?php foreach($event->getSpeakers() as $speaker) : ?>
    <?php include_partial('user/image_name_link', array('user' => $speaker)) ?>
    <?php echo link_to('Remove as speaker!', 'event_speaker_remove', array('sf_subject' => $event, 'username' => $speaker->getUsername()), array('method' => 'post')) ?>
  <?php endforeach ?>
<?php elseif($sf_user->isAuthenticated()) : ?>
  <p>None listed.</p>
<?php endif ?>