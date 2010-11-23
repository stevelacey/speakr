<?php

/**
 * Conference form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConferenceEventForm extends ConferenceForm {
  public $event;

  public function configure() {
    parent::configure();

    $this->event = new Event();
    $this->event->setConference($this->getObject());
    $this->embedForm('event', new EventForm($this->event));
  }
}