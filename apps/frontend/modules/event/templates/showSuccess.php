<article class="event hevent two columns" role="main">
  <header class="two columns">
    <div class="wide column">
      <hgroup>
        <h1><?php echo $event ?></h1>
        <h2><?php echo $event->getTagline() ?></h2>
      </hgroup>

      <time><?php echo $event->getDateTimeObject('start_at')->format('l jS F Y') ?></time>

      <?php if($event->getWebsite()) : ?>
        <?php echo link_to($event->getWebsite(), $event->getWebsite()) ?>
      <?php endif ?>

      <div class="icons">
        <?php include_partial('social', array('event' => $event)) ?>
        <?php if($sf_user->isAuthenticated()) : ?>
          <aside class="mini-actions">
            <?php include_partial('watch', array('event' => $event)) ?>

            <?php if($event->isOngoing() || $event->isOver()): ?>
              <?php include_partial('favourite', array('event' => $event)) ?>
            <?php endif ?>
          </aside>
        <?php endif ?>
      </div>
    </div>
    <div class="logo thin column">
      <?php if($event->getWebsite()) : ?>
        <?php echo link_to(image_tag('http://logo.stevelacey.net/'.$event->getWebsite(), array('alt' => $event->getName())), $event->getWebsite(), array('title' => $event->getName())) ?>
      <?php endif ?>
    </div>
  </header>
  
  <div class="two columns">
    <div class="wide column">
      <p><?php echo $event->getRawValue()->getDescription() ?></p>

      <?php if($sf_user->isAuthenticated() || (!$sf_user->isAuthenticated() && $event->getSpeakers()->count())) : ?>
        <section>
          <h2><?php echo link_to('Speakers', 'speakers', $event) ?></h2>
          <?php if($event->getSpeakers()->count()) : ?>
            <?php include_partial('user/image_name_list', array('users' => $event->getSpeakers())) ?>
          <?php else : ?>
            <p>None listed, why not <?php echo link_to('add some speakers', 'speakers', $event) ?>?</p>
          <?php endif ?>
        </section>
      <?php endif ?>

      <?php if($event->getPresentations()->count() /* || $event->getVideos()->count() */ ) : ?>
        <section>
          <h2>Content</h2>
          <?php if($event->getPresentations()->count()) : ?>
            <h3>Presentations</h3>
            <?php include_partial('presentation/list', array('presentations' => $event->getPresentations())) ?>
          <?php endif ?>
        </section>
      <?php endif ?>

      <section class="location">
        <h2>Location</h2>
        <p>
          <?php echo $event->getAddress() ?><br/>
          <?php echo $event->getPostcode() ?>
        </p>
      </section>

      <?php if($event->getAttending()->count()) : ?>
        <section>
          <h2>Attending</h2>
          <?php include_partial('user/image_list', array('users' => $event->getAttending())) ?>
        </section>
      <?php endif ?>
    </div>

    <aside class="thin column">
      <?php if($sf_user->isAuthenticated()) : ?>
        <section class="actions">
          <?php include_partial('attend', array('event' => $event)) ?>
          <?php include_partial('speak', array('event' => $event)) ?>
        </section>
      <?php endif ?>

      <section class="twitter">
        <h2>Twitter</h2>
        <?php if($event->getHashtag()) : ?>
          <p>#<span class="hashtag"><?php echo $event->getHashtag() ?></span></p>
        <?php endif ?>

        <?php if($sf_user->isAuthenticated()) : ?>
          <form action="<?php echo url_for('event_update', array('action' => 'hashtag', 'sf_subject' => $event)) ?>" method="post">
            <?php echo $forms['hashtag']['hashtag']->renderHelp() ?>
            <?php echo $forms['hashtag']['hashtag'] ?>
            <?php echo $forms['hashtag']->renderHiddenFields(false) ?>
            <input type="submit" value="Set Hashtag"/>
          </form>
        <?php endif ?>
      </section>
    </aside>
  </div>
</article>