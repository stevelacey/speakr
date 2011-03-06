<article role="main">
  <h1><?php echo $content->getTitle() ?></h1>

  <?php include_partial('user/icon_list', array('users' => $content->getSpeakers())) ?>

  <div class="two columns">
    <div class="wide column">
      <p><?php echo $content->getDescription() ?></p>
    </div>
    <div class="thin column">
      <h2>Presented at</h2>
      <?php foreach($content->getPresentations() as $presentation) : ?>
        <?php echo link_to($presentation->getEvent(), 'event', $presentation->getEvent()) ?>
        <div>
          <?php include_partial('user/icon_list', array('users' => $presentation->getSpeakers())) ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</article>