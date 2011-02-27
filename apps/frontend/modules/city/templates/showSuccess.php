<div>
  <hgroup>
    <h1><?php echo $city ?></h1>
    <h2><?php echo link_to($city->getRegion(), 'region', $city->getRegion()) ?>, <?php echo link_to($city->getRegion()->getCountry(), 'country', $city->getRegion()->getCountry()) ?>
  </hgroup>
  <div class="events">
    <?php include_partial('event/short_list', array('events' => $city->getEvents(), 'location' => false)) ?>
  </div>
</div>