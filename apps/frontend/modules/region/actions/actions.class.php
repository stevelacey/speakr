<?php

/**
 * region actions.
 *
 * @package    speakr
 * @subpackage region
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class regionActions extends myActions {
  public function executeShow(sfWebRequest $request) {
    $this->region = $this->getRoute()->getObject();
    $this->setTitle('Events in '.implode(', ', array($this->region, $this->region->getCountry())));
  }
}