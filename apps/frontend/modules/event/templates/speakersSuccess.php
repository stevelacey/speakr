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
    <section class="speakers wide column">
      <h2>Speakers</h2>
      <?php if($event->getSpeakers()->count()) : ?>
        <ul class="users details extra">
          <?php foreach($event->getSpeakers() as $speaker) : ?>
            <li>
              <?php include_partial('user/image_name_link', array('user' => $speaker)) ?>
              <?php echo link_to('Remove', 'event_speaker_remove', array('sf_subject' => $event, 'username' => $speaker->getUsername()), array('class' => 'action remove-icon', 'method' => 'post')) ?>
            </li>
          <?php endforeach ?>
        </ul>
      <?php elseif($sf_user->isAuthenticated()) : ?>
        <p>None listed.</p>
      <?php endif ?>
    </section>
    <section class="add-speaker thin column">
      <h2>Add Speaker</h2>
      <?php include_partial('user/search') ?>
    </section>
  </div>
</div>