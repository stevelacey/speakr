<?php

/**
 * content actions.
 *
 * @package    speakr
 * @subpackage content
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends sfActions {
  public function executeShow(sfWebRequest $request) {
    $this->content = $this->getRoute()->getObject();
  }

  public function executeSearch(sfWebRequest $request) {
    $results = array();

    if($request->hasParameter('query')) {
      foreach(Doctrine::getTable('Content')->search($request->getParameter('query')) as $content) {
        $result = array(
          'title' => $content->getTitle(),
          'slug' => $content->getSlug(),
          'description' => $content->getDescription(),
          'presentations' => array()
        );

        foreach($content->getPresentations() as $presentation) {
          $event = array (
            'name' => $presentation->getEvent()->getName(),
            'date' => $presentation->getEvent()->getDate(),
            'speakers' => array()
          );

          foreach($presentation->getSpeakers() as $speaker) {
            $event['speakers'][] = array(
              'name' => $speaker->__toString(),
              'username' => $speaker->getUsername(),
              'icon' => $speaker->getIcon()
            );
          }

          $result['presentations'][] = $event;
        }

        $results[] = $result;
      }
    }
    
    return $this->renderText(json_encode($results));
  }
}