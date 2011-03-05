<div>
  <hgroup>
    <h1><?php echo link_to($event, 'event', $event) ?></h1>
    <h2><?php echo $event->getTagline() ?></h2>
  </hgroup>
  <time><?php echo $event->getDateTimeObject('start_at')->format('l jS F Y') ?></time>

  <div>
    <img src="http://logo.stevelacey.net/<?php echo $event->getWebsite() ?>"/>
  </div>

  <div class="two columns">
    <section class="new-content column">
      <h2>Add New Content</h2>
    </section>

    <section class="existing-content column">
      <h2>Add Existing Content</h2>
      <p>Has the content been presented somewhere else? Add it to this event too!</p>
      <?php include_partial('content/search') ?>
    </section>
  </div>
</div>