<?php if($users->count()) : ?>
  <ul class="users icons">
    <?php foreach($users as $user) : ?>
      <li><?php include_partial('user/icon_link', array('user' => $user)) ?></li>
    <?php endforeach ?>
  </ul>
<?php endif ?>