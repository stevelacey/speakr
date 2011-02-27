<div>
  <hgroup>
    <h1><?php echo $region ?></h1>
    <h2><?php echo link_to($region->getCountry(), 'country', $region->getCountry()) ?>
  </hgroup>
  <div class="events">
    <?php include_partial('event/short_list', array('events' => $region->getEvents())) ?>
  </div>
</div>