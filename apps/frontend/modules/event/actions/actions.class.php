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
  public function executeShow(sfWebRequest $request) {
    $this->event = $this->getRoute()->getObject();
    $this->forms = array();

    if($this->getUser()->isAuthenticated()) {
      $user = $this->getUser()->getGuardUser();
      $this->forms = array(
        'hashtag' => new EventHashtagForm($this->event),
        'location' => new EventLocationForm($this->event)
      );
    }
  }

  public function executeSpeakers(sfWebRequest $request) {
    $this->event = $this->getRoute()->getObject();
  }

  public function executeAddContent(sfWebRequest $request) {
    $this->event = $this->getRoute()->getObject();
    $content = new Content();

    $presentation = new Presentation();
    $presentation->setEvent($this->event);

    $content->Presentations[] = $presentation;

    $this->form = new ContentForm($content);

    if($request->isMethod(sfRequest::POST)) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

      if ($this->form->isValid()) {
        $content = $this->form->save();
        $this->redirect('event', $this->event);
      }
    }
  }

  public function executeMap(sfWebRequest $request) {
    $event = $this->getRoute()->getObject();
    
    $google = new GoogleMapsAPI();
    $geodata = $google->geocode(array('address' => $event->getFormattedAddress()));
    
    $map = new StdClass();
    $map->event = new StdClass();
    $map->event->name = $event->getName();

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

  /* Update Actions */

  public function executeHashtag(sfWebRequest $request) {
    $event = $this->getRoute()->getObject();
    $this->form = new EventHashtagForm($event);

    if($request->isMethod(sfRequest::POST)) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
        $this->form->save();
      }
    }

    $this->redirect('event', $event);
  }

  public function executeLocation(sfWebRequest $request) {
    $event = $this->getRoute()->getObject();
    $this->form = new EventLocationForm($event);

    if($request->isMethod(sfRequest::POST)) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
        $this->form->save();
      }
    }

    $this->redirect('event', $event);
  }
}