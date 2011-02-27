<span class="date">
  <time class="dtstart" datetime="<?php echo $event->getStartDate('c') ?>">
    <?php if($event->getStartDate('dmY') == $event->getEndDate('dmY')) : ?>
      <?php echo $event->getStartDate('l jS F Y') ?>
    <?php elseif($event->getStartDate('mY') == $event->getEndDate('mY')) : ?>
      <?php echo $event->getStartDate('l jS') ?>
    <?php elseif($event->getStartDate('Y') == $event->getEndDate('Y')) : ?>
      <?php echo $event->getStartDate('l jS F') ?>
    <?php else : ?>
      <?php echo $event->getStartDate('l jS F Y') ?>
    <?php endif ?>
  </time>

  <?php if($event->getStartDate('dmY') != $event->getEndDate('dmY')) : ?>
    -
    <time class="dtend" datetime="<?php echo $event->getEndDate('c') ?>">
      <?php echo $event->getEndDate('l jS F Y') ?>
    </time>
  <?php endif ?>
</span>