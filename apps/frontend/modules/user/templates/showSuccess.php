<article role="main" class="two">
  <h1><?php echo $user->getName() ?></h1>
  <?php echo image_tag($user->getImage(), array('alt' => $user, 'class' => 'image')) ?>

  <div class="two columns">
    <section class="future column">
      <h2>Will be...</h2>
      <?php if($user->getOrganising()->count()) : ?>
        <h3>Organising</h3>
        <?php include_partial('event/short_list', array('events' => $user->getOrganising())) ?>
      <?php endif ?>

      <?php if($user->getSpeaking()->count()) : ?>
        <h3>Speaking at</h3>
        <?php include_partial('event/short_list', array('events' => $user->getSpeaking())) ?>
      <?php endif ?>

      <?php if($user->getSpeakingAlongside()->count()) : ?>
        <h3>Speaking alongside</h3>
        <?php include_partial('user/image_list', array('users' => $user->getSpeakingAlongside())) ?>
      <?php endif ?>

      <?php if($user->getAttending()->count()) : ?>
        <h3>Attending</h3>
        <?php include_partial('event/short_list', array('events' => $user->getAttending())) ?>
      <?php endif ?>
    </section>

    <div class="column">
      <?php if($user->getFavourites()->count()) : ?>
        <section class="favourites">
          <h2>Favourited...</h2>
          <?php include_partial('event/short_list', array('events' => $user->getFavourites())) ?>
        </section>
      <?php endif ?>
      <section class="past">
        <h2>Has...</h2>
        <?php if($user->getOrganised()->count()) : ?>
          <h3>Organised</h3>
          <?php include_partial('event/short_list', array('events' => $user->getOrganised())) ?>
        <?php endif ?>

        <?php if($user->getSpoken()->count()) : ?>
          <h3>Spoken at</h3>
          <?php include_partial('event/short_list', array('events' => $user->getSpoken())) ?>
        <?php endif ?>

        <?php if($user->getSpokenAlongside()->count()) : ?>
          <h3>Spoken alongside</h3>
          <?php include_partial('user/image_list', array('users' => $user->getSpokenAlongside())) ?>
        <?php endif ?>

        <?php if($user->getContent()->count()) : ?>
          <h3>Presented</h3>
          <?php include_partial('content/list', array('content' => $user->getContent())) ?>
        <?php endif ?>

        <?php if($user->getAttended()->count()) : ?>
          <h3>Attended</h3>
          <?php include_partial('event/short_list', array('events' => $user->getAttended())) ?>
        <?php endif ?>
      </section>
    </div>
  </div>
</article>