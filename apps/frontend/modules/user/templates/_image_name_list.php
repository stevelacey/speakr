<?php if($users->count()) : ?>
  <ul class="users details">
    <?php foreach($users as $user) : ?>
      <li><?php include_partial('user/image_name_link', array('user' => $user)) ?></li>
    <?php endforeach ?>
  </ul>
<?php endif ?>