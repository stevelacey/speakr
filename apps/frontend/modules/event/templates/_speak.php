<?php if(!$sf_user->getGuardUser()->isSpeaking($event->getRawValue())) : ?>
  <?php echo link_to('Speak', 'event_action', array('sf_subject' => $event, 'action' => 'speak', 'verb' => 'do'), array('class' => 'speak', 'method' => 'post')) ?>
<?php else : ?>
  <?php echo link_to('Stop Speaking', 'event_action', array('sf_subject' => $event, 'action' => 'speak', 'verb' => 'dont'), array('class' => 'speak', 'method' => 'post')) ?>
<?php endif ?>