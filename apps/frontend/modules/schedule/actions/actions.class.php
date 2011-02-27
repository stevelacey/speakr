<?php

/**
 * homepage actions.
 *
 * @package    speakr
 * @subpackage schedule
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class scheduleActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request) {
    $this->events = $this->getUser()->getGuardUser()->getAttending();
  }

  public function executeFriends(sfWebRequest $request) {
    $this->events = $this->getUser()->getGuardUser()->getFriendsEvents();
  }

  public function executeUpcoming(sfWebRequest $request) {
    $this->events = Doctrine::getTable('Event')->getUpcoming();
  }
}