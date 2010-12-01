<h1><?php echo $event ?></h1>
<h2><?php echo $event->getTagline() ?></h2>

<?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

<div>
  <img src="http://logo.stevelacey.net/<?php echo $event->getWebsite() ?>"/>
</div>

<?php include_partial('user/search') ?>

<h3>Speakers</h3>
<?php if($event->getSpeakers()->count()) : ?>
  <?php include_partial('user/image_name_list', array('users' => $event->getSpeakers())) ?>
<?php elseif($sf_user->isAuthenticated()) : ?>
  <p>None listed.</p>
<?php endif ?>