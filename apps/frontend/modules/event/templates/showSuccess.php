<article class="event">
  <h1><?php echo $event ?></h1>
  <h2><?php echo $event->getTagline() ?></h2>

  <?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

  <?php if($sf_user->isAuthenticated()) : ?>
    <?php if(!$attending) : ?>
      <?php echo link_to('Attend', 'event_action', array('sf_subject' => $event, 'action' => 'attend', 'verb' => 'do'), array('method' => 'post')) ?>
    <?php else : ?>
      <?php echo link_to('Stop Attending', 'event_action', array('sf_subject' => $event, 'action' => 'attend', 'verb' => 'dont'), array('method' => 'post')) ?>
    <?php endif ?>

    <?php if(!$speaking) : ?>
      <?php echo link_to('Speak', 'event_action', array('sf_subject' => $event, 'action' => 'speak', 'verb' => 'do'), array('method' => 'post')) ?>
    <?php else : ?>
      <?php echo link_to('Stop Speaking', 'event_action', array('sf_subject' => $event, 'action' => 'speak', 'verb' => 'dont'), array('method' => 'post')) ?>
    <?php endif ?>
    
    <?php if(!$watching) : ?>
      <?php echo link_to('Watch', 'event_action', array('sf_subject' => $event, 'action' => 'watch', 'verb' => 'do'), array('method' => 'post')) ?>
    <?php else : ?>
      <?php echo link_to('Stop Watching', 'event_action', array('sf_subject' => $event, 'action' => 'watch', 'verb' => 'dont'), array('method' => 'post')) ?>
    <?php endif ?>
  <?php endif ?>

  <div>
    <img src="http://logo.stevelacey.net/<?php echo $event->getWebsite() ?>"/>
  </div>

  <p><?php echo $event->getDescription() ?></p>

  <p>
    <?php echo $event->getAddress() ?><br/>
    <?php echo $event->getPostcode() ?>
  </p>

  <a href="<?php echo $event->getWebsite() ?>">Visit Website</a>
  
  <?php if($event->getHashtag()) : ?>
    <p>#<span class="hashtag"><?php echo $event->getHashtag() ?></span></p>
  <?php endif ?>

  <h3>Speakers</h3>
  <?php include_partial('user/image_name_list', array('users' => $event->getSpeakers())) ?>

  <h3>Attending</h3>
  <?php include_partial('user/image_list', array('users' => $event->getAttending())) ?>

  <h3>Presentations</h3>
  <?php foreach($event->getPresentations() as $presentation) : ?>
    <?php echo link_to($presentation, 'presentation', $presentation->getContent()) ?>
    <div>
      <?php include_partial('user/icon_list', array('users' => $presentation->getSpeakers())) ?>
    </div>
  <?php endforeach ?>
  
</article>