<?php

/**
 * Event form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventLocationForm extends EventForm {
  public function configure() {
    $this->useFields(array('address', 'postcode', 'city_id'));
  }
}