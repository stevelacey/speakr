<?php

/**
 * Content form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContentForm extends BaseContentForm {
  public function configure() {

    unset(
      $this['slug'],
      $this['created_at'], $this['updated_at']
    );
  }
}
