<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('new') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td><?php echo $form['name'] ?></td>
        <td><?php echo $form['name']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['website']->renderLabel() ?></th>
        <td><?php echo $form['event']['website'] ?></td>
        <td><?php echo $form['event']['website']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['date']->renderLabel() ?></th>
        <td><?php echo $form['event']['date'] ?></td>
        <td><?php echo $form['event']['date']->renderError() ?></td>
      </tr>
      <tr>
        <th><?php echo $form['event']['location']->renderLabel() ?></th>
        <td><?php echo $form['event']['location'] ?></td>
        <td><?php echo $form['event']['location']->renderError() ?></td>
      </tr>
      <tr>
        <td><?php echo $form['event']['city_id'] ?></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Add Event" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
