<h1><?php echo $event ?></h1>
<h2><?php echo $event->getTagline() ?></h2>

<?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

<?php if($sf_user->isAuthenticated()) : ?>
  <?php if(!$attending) : ?>
    <?php echo link_to('Attend', 'event_action', array('sf_subject' => $event, 'action' => 'attend')) ?>
  <?php else : ?>
    <?php echo link_to('Stop Attending', 'event_action', array('sf_subject' => $event, 'action' => 'unattend')) ?>
  <?php endif ?>

  <?php if(!$watching) : ?>
    <?php echo link_to('Watch', 'event_action', array('sf_subject' => $event, 'action' => 'watch')) ?>
  <?php else : ?>
    <?php echo link_to('Stop Watching', 'event_action', array('sf_subject' => $event, 'action' => 'unwatch')) ?>
  <?php endif ?>
<?php endif ?>

<p><?php echo $event->getDescription() ?></p>

<p>
  <?php echo $event->getAddress() ?><br/>
  <?php echo $event->getPostcode() ?>
</p>

<a href="<?php echo $event->getWebsite() ?>">Visit Website</a>
<p>#<?php echo $event->getHashtag() ?></p>
