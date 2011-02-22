<?php

/**
 * Event form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventHashtagForm extends EventForm {
  public function configure() {
    $this->useFields(array('hashtag'));
    $this->widgetSchema->setHelp('hashtag', 'Tell us the hashtag for this event and we\'ll pull the tweets for all to see.');
    $this->getWidgetSchema()->getFormFormatter()->setHelpFormat('<p>%help%</p>');
    unset($this['id']);
  }
}