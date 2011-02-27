<div>
  <h3><?php echo link_to($event, 'event', $event) ?></h3>
  <?php include_partial('event/location', array('event' => $event)) ?>
  <?php echo $event->getDateTimeObject('start_at')->format('l jS F Y') ?>

  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getFriendsAttendingOrSpeaking($event->getRawValue())->count()) : ?>
    <?php include_partial('user/icon_list', array('users' => $sf_user->getGuardUser()->getFriendsAttendingOrSpeaking($event->getRawValue()))) ?>
  <?php endif ?>
</div>