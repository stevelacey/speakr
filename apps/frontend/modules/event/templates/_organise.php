<?php if(!$sf_user->getGuardUser()->isOrganising($event->getRawValue())) : ?>
  <?php echo link_to('Organise', 'event_action', array('sf_subject' => $event, 'action' => 'speak', 'verb' => 'do'), array('method' => 'post')) ?>
<?php else : ?>
  <?php echo link_to('Stop Organising', 'event_action', array('sf_subject' => $event, 'action' => 'organise', 'verb' => 'dont'), array('method' => 'post')) ?>
<?php endif ?>