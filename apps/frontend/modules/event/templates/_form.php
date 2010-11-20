<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('new') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td><?php echo $form['title'] ?></td>
        <td><?php echo $form['title']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['url']->renderLabel() ?></th>
        <td><?php echo $form['url'] ?></td>
        <td><?php echo $form['url']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['tagline']->renderLabel() ?></th>
        <td><?php echo $form['event']['tagline'] ?></td>
        <td><?php echo $form['event']['tagline']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['date']->renderLabel() ?></th>
        <td><?php echo $form['event']['date'] ?></td>
        <td><?php echo $form['event']['date']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['location_id']->renderLabel() ?></th>
        <td><?php echo $form['event']['location_id'] ?></td>
        <td><?php echo $form['event']['location_id']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['description']->renderLabel() ?></th>
        <td><?php echo $form['event']['description'] ?></td>
        <td><?php echo $form['event']['description']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['url']->renderLabel() ?></th>
        <td><?php echo $form['event']['url'] ?></td>
        <td><?php echo $form['event']['url']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['image']->renderLabel() ?></th>
        <td><?php echo $form['event']['image'] ?></td>
        <td><?php echo $form['event']['image']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['hashtag']->renderLabel() ?></th>
        <td><?php echo $form['event']['hashtag'] ?></td>
        <td><?php echo $form['event']['hashtag']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['address']->renderLabel() ?></th>
        <td><?php echo $form['event']['address'] ?></td>
        <td><?php echo $form['event']['address']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['postcode']->renderLabel() ?></th>
        <td><?php echo $form['event']['postcode'] ?></td>
        <td><?php echo $form['event']['postcode']->renderError() ?></td>
      </tr>
    </tbody>
  </table>
</form>
