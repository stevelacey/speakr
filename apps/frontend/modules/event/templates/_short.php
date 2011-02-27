<li class="event vevent">
  <h3><?php echo link_to($event, 'event', $event, array('class' => 'summary url')) ?></h3>
  <span class="details">
    <?php include_partial('event/location', array('event' => $event)) ?>
    <?php include_partial('event/date', array('event' => $event)) ?>
  </span>

  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getFriendsAttendingOrSpeaking($event->getRawValue())->count()) : ?>
    <?php include_partial('user/icon_list', array('users' => $sf_user->getGuardUser()->getFriendsAttendingOrSpeaking($event->getRawValue()))) ?>
  <?php endif ?>
</li>