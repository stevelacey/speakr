<?php if(!$sf_user->getGuardUser()->isAttending($event->getRawValue())) : ?>
  <?php echo link_to('Attend', 'event_action', array('sf_subject' => $event, 'action' => 'attend', 'verb' => 'do'), array('method' => 'post')) ?>
<?php else : ?>
  <?php echo link_to('Stop Attending', 'event_action', array('sf_subject' => $event, 'action' => 'attend', 'verb' => 'dont'), array('method' => 'post')) ?>
<?php endif ?>