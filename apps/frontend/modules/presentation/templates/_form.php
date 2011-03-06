<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('add_content', $event) ?>" method="post">
  <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif ?>
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <?php if($form->getObject()->getContent()->isNew()) : ?>
        <tr>
          <th><?php echo $form['content']['title']->renderLabel() ?></th>
          <td><?php echo $form['content']['title'] ?></td>
          <td><?php echo $form['content']['title']->renderError() ?></td>
        </tr>
        <tr>
          <th><?php echo $form['content']['description']->renderLabel() ?></th>
          <td><?php echo $form['content']['description'] ?></td>
          <td><?php echo $form['content']['description']->renderError() ?></td>
        </tr>
      <?php endif ?>
      <tr>
        <th><?php echo $form['speakers_list']->renderLabel() ?></th>
        <td><?php echo $form['speakers_list'] ?></td>
        <td><?php echo $form['speakers_list']->renderError() ?></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php if($form->getObject()->getContent()->isNew()) : ?>
            <p>You'll have an opportunity to add slides, videos and more at the next step.</p>
          <?php endif ?>
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Add New Content" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
