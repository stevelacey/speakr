<span class="location">
  <?php if($event->getAddress()) : ?>
    <span class="street-address"><?php echo $event->getAddress() ?></span>
  <?php endif ?>

  <?php echo link_to($event->getCity(), 'city', $event->getCity(), array('class' => 'locality')) ?>
  <?php echo link_to($event->getCity()->getRegion(), 'region', $event->getCity()->getRegion(), array('class' => 'region')) ?>

  <?php if($event->getPostcode()) : ?>
    <span class="postal-code"><?php echo $event->getPostcode() ?></span>
  <?php endif ?>

  <?php echo link_to($event->getCity()->getRegion()->getCountry(), 'country', $event->getCity()->getRegion()->getCountry(), array('class' => 'country-name')) ?>
</span>