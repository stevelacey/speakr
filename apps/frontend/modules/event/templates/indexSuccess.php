<h1>Events List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Conference</th>
      <th>Title</th>
      <th>Tagline</th>
      <th>Date</th>
      <th>Location</th>
      <th>Description</th>
      <th>Url</th>
      <th>Image</th>
      <th>Icon</th>
      <th>Hashtag</th>
      <th>Address</th>
      <th>Postcode</th>
      <th>Slug</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo $event->getId() ?></a></td>
      <td><?php echo $event->getConferenceId() ?></td>
      <td><?php echo $event->getTitle() ?></td>
      <td><?php echo $event->getTagline() ?></td>
      <td><?php echo $event->getDate() ?></td>
      <td><?php echo $event->getLocationId() ?></td>
      <td><?php echo $event->getDescription() ?></td>
      <td><?php echo $event->getUrl() ?></td>
      <td><?php echo $event->getImage() ?></td>
      <td><?php echo $event->getIcon() ?></td>
      <td><?php echo $event->getHashtag() ?></td>
      <td><?php echo $event->getAddress() ?></td>
      <td><?php echo $event->getPostcode() ?></td>
      <td><?php echo $event->getSlug() ?></td>
      <td><?php echo $event->getCreatedAt() ?></td>
      <td><?php echo $event->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('event/new') ?>">New</a>
