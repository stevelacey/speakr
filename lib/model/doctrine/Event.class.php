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
  public function getTitle() {
    return $this->getConference()->getTitle().' '.$this->getDateTimeObject('date')->format('Y');
  }

  public function getFormattedAddress() {
    return $this->getAddress().', '.$this->getLocation().', '.$this->getPostcode().', '.$this->getLocation()->getCountry();
  }

  public function getSlug() {
    return $this->getConference()->getSlug().'-'.$this->getDateTimeObject('date')->format('Y');
  }
}