<h1><?php echo $event ?></h1>
<h2><?php echo $event->getTagline() ?></h2>

<?php echo $event->getDateTimeObject('date')->format('l jS F Y') ?>

<p><?php echo $event->getDescription() ?></p>
<a href="<?php echo $event->getWebsite() ?>">Visit Website</a>

#<?php echo $event->getHashtag() ?>
Address: <?php echo $event->getAddress() ?></td>
<?php echo $event->getPostcode() ?>