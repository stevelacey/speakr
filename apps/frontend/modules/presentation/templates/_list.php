<?php foreach($presentations as $presentation) : ?>
  <?php echo link_to($presentation, 'presentation', $presentation->getContent()) ?>
  <div>
    <?php include_partial('user/icon_list', array('users' => $presentation->getSpeakers())) ?>
  </div>
<?php endforeach ?>