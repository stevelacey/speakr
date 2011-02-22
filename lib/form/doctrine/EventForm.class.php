<?php

/**
 * Event form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm {
  public function configure() {
//    $this->useFields(array('tagline', 'date', 'description', 'url', 'image', 'hashtag', 'address', 'postcode'));
    $this->widgetSchema['date'] = new sfWidgetFormI18nDate(array(
      'format' => '%day%/%month%/%year%',
      'culture' => 'en'
    ));
    
    $this->widgetSchema['location'] = new sfWidgetFormInputText();
    $this->widgetSchema['woeid'] = new sfWidgetFormInputText();

    if($this->getObject()->isNew()) {
      unset($this['id'], $this['conference_id'], $this['tagline'], $this['description'], $this['hashtag'], $this['address'], $this['postcode']);
    }

    unset(
      $this['location_id'], $this['image'], $this['icon'],
      $this['attending_list'], $this['favouriters_list'], $this['organisers_list'], $this['speakers_list'], $this['watchers_list'],
      $this['created_at'], $this['updated_at']
    );
  }
}