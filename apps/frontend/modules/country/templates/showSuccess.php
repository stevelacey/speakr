<div>
  <hgroup>
    <h1><?php echo $country ?></h1>
  </hgroup>
  <div class="events">
    <?php include_partial('event/short_list', array('events' => $country->getEvents(), 'location' => false)) ?>
  </div>
</div>