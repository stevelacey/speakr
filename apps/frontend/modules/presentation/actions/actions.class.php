<?php

/**
 * presentation actions.
 *
 * @package    speakr
 * @subpackage presentation
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class presentationActions extends sfActions {
  public function executeShow(sfWebRequest $request) {
    $this->content = $this->getRoute()->getObject();
  }
}