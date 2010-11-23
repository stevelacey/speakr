<?php foreach($users as $user) : ?>
  <?php include_partial('user/image_name_link', array('user' => $user)) ?>
<?php endforeach ?>