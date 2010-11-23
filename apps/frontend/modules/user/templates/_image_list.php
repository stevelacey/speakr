<?php foreach($users as $user) : ?>
  <?php include_partial('user/image_link', array('user' => $user)) ?>
<?php endforeach ?>