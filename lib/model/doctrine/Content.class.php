<?php

/**
 * Content
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Content extends BaseContent {
  public function getPresentations() {
    return Doctrine_Query::create()->
      from('Presentation p')->
      leftJoin('p.Event e')->
      where('p.content_id = ?', $this->getId())->
      orderBy('e.end_at desc')->
      execute();
  }

  public function getSpeakers() {
    return Doctrine_Query::create()->
      from('sfGuardUser u')->
      leftJoin('u.PresentationUser pu')->
      leftJoin('pu.Presentation p')->
      leftJoin('p.Content c')->
      where('c.id = ?', $this->getId())->
      execute();
  }

  public function getSpeakerSlug() {
    $speakers = array();

    foreach($this->getSpeakers() as $speaker) {
      $speakers[] = $speaker->getUsername();
    }

    return implode('-and-', $speakers);
  }
}