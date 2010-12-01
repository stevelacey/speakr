<?php

/**
 * event actions.
 *
 * @package    speakr
 * @subpackage event
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends myEventActions {
  public function executeIndex(sfWebRequest $request) {
    $this->events = Doctrine::getTable('Event')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request) {
    $this->event = $this->getRoute()->getObject();

    if($this->getUser()->isAuthenticated()) {
      $user = $this->getUser()->getGuardUser();
      $this->attending = $user->isAttending($this->event);
      $this->favouriter = $user->isFavouriting($this->event);
      $this->organising = $user->isOrganising($this->event);
      $this->speaking = $user->isSpeaking($this->event);
      $this->watching = $user->isWatching($this->event);
    }
  }

  public function executeSpeakers(sfWebRequest $request) {
    $this->event = $this->getRoute()->getObject();
  }

  public function executeMap(sfWebRequest $request) {
    $event = $this->getRoute()->getObject();
    
    $google = new GoogleMapsAPI();
    $geodata = $google->geocode(array('address' => $event->getFormattedAddress()));
    
    $map = new StdClass();
    $map->event = new StdClass();
    $map->event->title = $event->getTitle();

    if($geodata->status == 'OK') {
      $map->event->latitude = $geodata->results[0]->geometry->location->lat;
      $map->event->longitude = $geodata->results[0]->geometry->location->lng;
    }

    return $this->renderText(json_encode($map));
  }

  public function executeNew(sfWebRequest $request) {
    $this->form = new ConferenceEventForm();

    if($request->isMethod(sfRequest::POST)) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
        $this->form->save();
        $this->redirect('event', $this->form->event);
      }
    }
  }

  public function executeEdit(sfWebRequest $request) {
    $this->forward404Unless($event = Doctrine::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $this->form = new EventForm($event);
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($event = Doctrine::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $this->form = new EventForm($event);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request) {
    $request->checkCSRFProtection();

    $this->forward404Unless($event = Doctrine::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $event->delete();

    $this->redirect('event/index');
  }
}