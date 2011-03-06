<?php if($results) : ?>
  <ol>
    <?php foreach($results as $form) : ?>
      <li>
        <h3><?php echo $form->getObject()->getContent() ?></h3>
        <div class="two columns">
          <div class="wide column">
            <?php include_partial('presentation/form', array('event' => $event, 'form' => $form)) ?>
          </div>
          <div class="thin column">
            <h4>Also presented at:</h4>
            <ul class="presentations thin column">
              <?php foreach($form->getObject()->getContent()->getPresentations() as $presentation) : ?>
                <li>
                  <h5><?php echo $presentation->getEvent() ?></h5>
                  <?php include_partial('user/icon_list', array('users' => $presentation->getSpeakers())) ?>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
      </li>
    <?php endforeach ?>
  </ol>
<?php endif ?>