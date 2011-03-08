<?php

/**
 * my actions.
 *
 * @package    speakr
 * @subpackage event
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myActions extends sfActions {
  /**
   * Pre Executes all actions
   */
  public function preExecute() {
    $d = ' | ';
    $t = sfConfig::get('app_site_title');
    $this->title = array('d' => $d, 't' => $t);
    $this->response = $this->getResponse();
  }

  /**
   * Sets the Page Title
   * @param string $title The page title
   */
  public function setTitle($title = '') {
    $this->response->setTitle($title . $this->title['d'] . $this->title['t'], false);
  }
}