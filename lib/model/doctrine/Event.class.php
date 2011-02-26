<?php

/**
 * Event
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Event extends BaseEvent {
  public function getName() {
    return $this->getConference()->getName().' '.$this->getDateTimeObject('start_at')->format('Y');
  }

  public function getFormattedAddress() {
    return implode(', ', array(
      $this->getAddress(),
      $this->getCity(),
      $this->getRegion(),
      $this->getPostcode(),
      $this->getCountry()
    ));
  }

  public function getSlug() {
    return $this->getConference()->getSlug().'-'.$this->getDateTimeObject('start_at')->format('Y');
  }

  public function getRegion() {
    return $this->getCity()->getRegion();
  }

  public function getCountry() {
    return $this->getRegion()->getCountry();
  }

  public function setup() {
    parent::setup();
    $this->actAs(new Doctrine_Template_HidePastEvents(array('name' => 'start_at')));
  }
}