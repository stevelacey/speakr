<?php

/**
 * event actions.
 *
 * @package    speakr
 * @subpackage event
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myEventActions extends sfActions {
  public function executeAttend(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'attend', $request->getParameter('verb') == 'do');
  }

  public function executeFavourite(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'favourite', $request->getParameter('verb') == 'do');
  }

  public function executeOrganise(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'organise', $request->getParameter('verb') == 'do');
  }

  public function executeSpeak(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'speak', $request->getParameter('verb') == 'do');
  }

  public function executeWatch(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'watch', $request->getParameter('verb') == 'do');
  }

  public function executeAddSpeaker(sfWebRequest $request) {
    $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username'));

    if($user instanceOf sfGuardUser) {
      $this->go($request, $user, 'speak', true);
    }
  }

  public function executeRemoveSpeaker(sfWebRequest $request) {
    $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username'));
    
    if($user instanceOf sfGuardUser) {
      $this->go($request, $user, 'speak', false);
    }
  }

  public function go(sfWebRequest $request, $user, $relation, $action) {
//    $request->checkCSRFProtection();
    call_user_func_array(array($user, $relation), array($this->getRoute()->getObject(), $action));
    $this->redirect($this->getUser()->getReferer($request->getReferer()));
  }
}