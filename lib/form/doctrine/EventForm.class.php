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
    foreach(array('start_at', 'end_at') as $date) {
      $this->widgetSchema[$date] = new sfWidgetFormI18nDate(array(
        'format' => '%day%/%month%/%year%',
        'culture' => 'en'
      ));
    }

    $this->configureLocation();

    unset(
      $this['id'], $this['conference_id'], $this['tagline'], $this['description'], $this['hashtag'], $this['address'], $this['postcode'],
      $this['image'], $this['icon'],
      $this['attending_list'], $this['favouriters_list'], $this['organisers_list'], $this['speakers_list'], $this['watchers_list'],
      $this['created_at'], $this['updated_at']
    );
  }

  public function configureLocation() {
    $this->widgetSchema['location'] = new sfWidgetFormInputText();
    $this->widgetSchema['city_id'] = new sfWidgetFormInputHidden();

    if(!$this->getObject()->isNew()) {
      $this->widgetSchema['location']->setDefault($this->getObject()->getLocation());
      $this->getObject()->setCityId(null);

    }

    $this->validatorSchema['location'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['city_id'] = new sfValidatorPass();

    $this->mergePostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkLocation')))
    );
  }

  public function checkLocation($validator, $values) {
    $city = Doctrine::getTable('City')->findOneById($values['city_id']);

    if(!$city instanceOf City) {
      if($values['location']) {
        $web = new sfWebBrowser();

        $web->get('http://query.yahooapis.com/v1/public/yql', array('q' => 'select * from geo.places where text = "'.$values['location'].'" and placetype = 7'));

        if (!$web->responseIsError()) {
          // Successful response (eg. 200, 201, etc)
          $city = Doctrine::getTable('City')->findOneById((int) $web->getResponseXML()->results->place[0]->woeid);

          if($city instanceOf City) {
            $values['city_id'] = $city->getId();
          } else {
            $error = new sfValidatorError($validator, 'We\'re not sure where this is, could you check you\'ve entered the location correctly?');
            throw new sfValidatorErrorSchema($validator, array('location' => $error));
          }
        } else {
          // Error response (eg. 404, 500, etc)
        }
      }
    }

    // location is set, return the clean values
    return $values;
  }
}