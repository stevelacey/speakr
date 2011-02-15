<?php if($users->count()) : ?>
  <ul class="users">
    <?php foreach($users as $user) : ?>
      <li><?php include_partial('user/image_link', array('user' => $user)) ?></li>
    <?php endforeach ?>
  </ul>
<?php endif ?>