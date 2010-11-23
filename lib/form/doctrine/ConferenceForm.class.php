<?php

/**
 * Conference form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConferenceForm extends BaseConferenceForm {
  public function configure() {
    $this->useFields(array('title', 'url', 'image'));
  }
}