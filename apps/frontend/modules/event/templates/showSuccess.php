<article class="event hevent two columns" role="main">
  <header class="two columns">
    <div class="wide column">
      <hgroup>
        <h1><?php echo $event ?></h1>
        <?php if($event->getTagline()) : ?>
          <h2><?php echo $event->getTagline() ?></h2>
        <?php endif ?>
      </hgroup>

      <?php include_partial('event/date', array('event' => $event)) ?>

      <?php if($event->getWebsite()) : ?>
        <?php echo link_to($event->getWebsite(), $event->getWebsite(), array('class' => 'website')) ?>
      <?php endif ?>

      <div class="icons">
        <?php include_partial('social', array('event' => $event)) ?>
        <?php if($sf_user->isAuthenticated()) : ?>
          <aside class="mini-actions">
            <?php if(!$event->isOver()): ?>
              <?php include_partial('watch', array('event' => $event)) ?>
            <?php endif ?>

            <?php if($event->isOngoing() || $event->isOver()): ?>
              <?php include_partial('favourite', array('event' => $event)) ?>
            <?php endif ?>
          </aside>
        <?php endif ?>
      </div>
    </div>
    <div class="logo thin column">
      <?php if($event->getWebsite()) : ?>
        <?php echo link_to(image_tag('http://logo.no.de/'.$event->getWebsite(), array('alt' => $event->getName())), $event->getWebsite(), array('title' => $event->getName())) ?>
      <?php endif ?>
    </div>
  </header>
  
  <div class="two columns">
    <div class="wide column">
      <section class="description">
        <div class="content">
          <?php if($event->getDescription()) : ?>
            <?php echo nl2br($event->getDescription()) ?>
          <?php else : ?>
            Double-click to add some description!
          <?php endif ?>
        </div>

        <?php if($sf_user->isAuthenticated()) : ?>
          <form action="<?php echo url_for('event_update', array('action' => 'description', 'sf_subject' => $event)) ?>" method="post">
            <fieldset>
              <div>
                <?php echo $forms['description']['description'] ?>
              </div>
            </fieldset>
            <?php echo $forms['description']->renderHiddenFields(false) ?>
            <input type="submit" value="Update Description"/>
          </form>
        <?php endif ?>
      </section>

      <?php if($sf_user->isAuthenticated() || $event->getSpeakers()->count()) : ?>
        <section class="speakers">
          <header>
            <h2>Speakers</h2>
            <?php if($sf_user->isAuthenticated()) : ?>
              <?php echo link_to($event->getSpeakers()->count() ? 'Edit' : 'Add', 'speakers', $event, array('class' => 'add')) ?>
            <?php endif ?>
          </header>
          <?php if($event->getSpeakers()->count()) : ?>
            <?php include_partial('user/image_name_list', array('users' => $event->getSpeakers())) ?>
          <?php else : ?>
            <p>None listed, why not <?php echo link_to('add some speakers', 'speakers', $event) ?>?</p>
          <?php endif ?>
        </section>
      <?php endif ?>

      <?php if($sf_user->isAuthenticated() || $event->getPresentations()->count()) : ?>
        <section class="content">
          <header>
            <h2>Content</h2>
            <?php if($sf_user->isAuthenticated()) : ?>
              <?php echo link_to('Add', 'add_content', $event, array('class' => 'add')) ?>
            <?php endif ?>
          </header>
          <?php if($event->getPresentations()->count()) : ?>
            <?php include_partial('presentation/list', array('presentations' => $event->getPresentations())) ?>
          <?php else : ?>
            <p>
              None listed,
              <?php if($event->getSpeakers()->count()) : ?>
                why not <?php echo link_to('add some content', 'add_content', $event) ?>?
              <?php else : ?>
                <?php echo link_to('add some speakers', 'speakers', $event) ?> to be able to start adding content.
              <?php endif ?>
            </p>
          <?php endif ?>
        </section>
      <?php endif ?>

      <section class="location">
        <header>
          <h2>Location</h2>
        </header>
        <section class="address">
          <div>
            <?php include_partial('event/location', array('event' => $event)) ?>
          </div>
          <?php if($sf_user->isAuthenticated()) : ?>
            <form action="<?php echo url_for('event_update', array('action' => 'location', 'sf_subject' => $event)) ?>" method="post">
              <fieldset>
                <div>
                  <?php echo $forms['location']['address']->renderLabel() ?>
                  <?php echo $forms['location']['address'] ?>
                </div>
                <div>
                  <?php echo $forms['location']['postcode']->renderLabel() ?>
                  <?php echo $forms['location']['postcode'] ?>
                </div>
                <div>
                  <?php echo $forms['location']['location']->renderLabel() ?>
                  <?php echo $forms['location']['location'] ?>
                </div>
              </fieldset>
              <?php echo $forms['location']->renderHiddenFields(false) ?>
              <input type="submit" value="Set Location"/>
            </form>
          <?php endif ?>
        </section>
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

      <?php if($sf_user->isAuthenticated() || $event->getHashtag()) : ?>
        <section class="twitter">
          <header>
            <h2>Twitter</h2>
          </header>
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
      <?php endif ?>
    </aside>
  </div>
</article>
