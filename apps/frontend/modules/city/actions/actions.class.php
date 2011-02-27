<?php

/**
 * city actions.
 *
 * @package    speakr
 * @subpackage city
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cityActions extends sfActions {
  public function executeShow(sfWebRequest $request) {
    $this->city = $this->getRoute()->getObject();
  }
}