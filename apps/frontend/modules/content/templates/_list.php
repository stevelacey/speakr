<?php foreach($content as $c) : ?>
  <?php echo link_to($c, 'content', $c) ?>
  <div>
    <?php include_partial('user/icon_list', array('users' => $c->getSpeakers())) ?>
  </div>
<?php endforeach ?>