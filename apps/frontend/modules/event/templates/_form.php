<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('event/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('event/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'event/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['conference_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['conference_id']->renderError() ?>
          <?php echo $form['conference_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tagline']->renderLabel() ?></th>
        <td>
          <?php echo $form['tagline']->renderError() ?>
          <?php echo $form['tagline'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['date']->renderLabel() ?></th>
        <td>
          <?php echo $form['date']->renderError() ?>
          <?php echo $form['date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['location_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['location_id']->renderError() ?>
          <?php echo $form['location_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['url']->renderLabel() ?></th>
        <td>
          <?php echo $form['url']->renderError() ?>
          <?php echo $form['url'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['image']->renderLabel() ?></th>
        <td>
          <?php echo $form['image']->renderError() ?>
          <?php echo $form['image'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['icon']->renderLabel() ?></th>
        <td>
          <?php echo $form['icon']->renderError() ?>
          <?php echo $form['icon'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['hashtag']->renderLabel() ?></th>
        <td>
          <?php echo $form['hashtag']->renderError() ?>
          <?php echo $form['hashtag'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['address']->renderLabel() ?></th>
        <td>
          <?php echo $form['address']->renderError() ?>
          <?php echo $form['address'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['postcode']->renderLabel() ?></th>
        <td>
          <?php echo $form['postcode']->renderError() ?>
          <?php echo $form['postcode'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['slug']->renderLabel() ?></th>
        <td>
          <?php echo $form['slug']->renderError() ?>
          <?php echo $form['slug'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['attending_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['attending_list']->renderError() ?>
          <?php echo $form['attending_list'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['favouriters_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['favouriters_list']->renderError() ?>
          <?php echo $form['favouriters_list'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['organisers_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['organisers_list']->renderError() ?>
          <?php echo $form['organisers_list'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['speakers_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['speakers_list']->renderError() ?>
          <?php echo $form['speakers_list'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['watchers_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['watchers_list']->renderError() ?>
          <?php echo $form['watchers_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
