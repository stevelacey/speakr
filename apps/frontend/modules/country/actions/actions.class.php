<?php

/**
 * country actions.
 *
 * @package    speakr
 * @subpackage country
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class countryActions extends myActions {
  public function executeShow(sfWebRequest $request) {
    $this->country = $this->getRoute()->getObject();
    $this->setTitle('Events in '.$this->country);
  }
}