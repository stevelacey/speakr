<form action="<?php echo url_for('user_search') ?>" method="get" class="user_search">
  <label for="query">Search users</label>
  <input name="query" type="text" class="query"/>
  <input type="submit" value="Search"/>
  <?php include_partial('user/image_name_link_action.jqote') ?>
</form>