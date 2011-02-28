<?php if(!$sf_user->getGuardUser()->isWatching($event->getRawValue())) : ?>
  <?php echo link_to('Watch this event', 'event_action', array('sf_subject' => $event, 'action' => 'watch', 'verb' => 'do'), array('class' => 'watch not-watching', 'title' => 'Watch this event', 'method' => 'post'))?>
<?php else : ?>
  <?php echo link_to('Stop watching this event', 'event_action', array('sf_subject' => $event, 'action' => 'watch', 'verb' => 'dont'), array('class' => 'watch', 'title' => 'Stop watching this event', 'method' => 'post'))?>
<?php endif ?>