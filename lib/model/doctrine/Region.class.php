<?php

/**
 * Region
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Region extends BaseRegion {
  public function getCountrySlug() {
    return $this->getCountry()->getSlug();
  }

  public function getEvents() {
    return Doctrine_Query::create()->
      from('Event e')->
      leftJoin('e.City c')->
      leftJoin('c.Region r')->
      where('r.id = ?', $this->getId())->
      execute();
  }
}