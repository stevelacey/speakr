<form action="<?php echo url_for('content_search') ?>" method="get" class="content_search">
  <label for="query">Search content</label>
  <input name="query" type="text" class="query"/>
  <input type="submit" value="Search"/>
  <?php include_partial('content/search_result.jqote') ?>
</form>