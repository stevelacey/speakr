<?php if(!$sf_user->getGuardUser()->isFavouriting($event->getRawValue())) : ?>
  <?php echo link_to('Favourite this event', 'event_action', array('sf_subject' => $event, 'action' => 'favourite', 'verb' => 'do'), array('class' => 'favourite not-favourite', 'title' => 'Favourite this event', 'method' => 'post'))?>
<?php else : ?>
  <?php echo link_to('Unfavourite this event', 'event_action', array('sf_subject' => $event, 'action' => 'favourite', 'verb' => 'dont'), array('class' => 'favourite', 'title' => 'Unfavourite this event', 'method' => 'post'))?>
<?php endif ?>