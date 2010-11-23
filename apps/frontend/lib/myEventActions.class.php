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
    $this->go($request, 'attend');
  }

  public function executeFavourite(sfWebRequest $request) {
    $this->go($request, 'favourite');
  }

  public function executeOrganise(sfWebRequest $request) {
    $this->go($request, 'organise');
  }

  public function executeSpeak(sfWebRequest $request) {
    $this->go($request, 'speak');
  }

  public function executeWatch(sfWebRequest $request) {
    $this->go($request, 'watch');
  }

  public function go(sfWebRequest $request, $relation) {
    call_user_func_array(array($this->getUser()->getGuardUser(), $relation), array($this->getRoute()->getObject(), $request->getParameter('verb') == 'do'));
    $this->redirect($this->getUser()->getReferer($request->getReferer()));
  }
}