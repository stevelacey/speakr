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

  public function getDate() {
    if($this->getStartDate('dmY') == $this->getEndDate('dmY')) {
      $date = $this->getStartDate('l jS F Y');
    } else if($this->getStartDate('mY') == $this->getEndDate('mY')) {
      $date = $this->getStartDate('l jS');
    } else if($this->getStartDate('Y') == $this->getEndDate('Y')) {
      $date = $this->getStartDate('l jS F');
    } else {
      $date = $this->getStartDate('l jS F Y');
    }

    if($this->getStartDate('dmY') != $this->getEndDate('dmY')) {
      $date .= '-'.$this->getEndDate('l jS F Y');
    }

    return $date;
  }

  public function getStartDate($format) {
    return $this->getDateTimeObject('start_at')->format($format);
  }

  public function getEndDate($format) {
    return $this->getDateTimeObject('end_at')->format($format);
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

  public function isUpcoming() {
    return $this->getStartDate('U') >= time();
  }

  public function isOngoing() {
    return $this->getStartDate('U') <= time() && $this->getEndDate('U') >= time();
  }

  public function isOver() {
    return $this->getEndDate('U') <= time();
  }
}