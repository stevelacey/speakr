<h3><?php echo link_to($event, 'event', $event) ?></h3>
<?php include_partial('event/location', array('event' => $event)) ?>
<?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>