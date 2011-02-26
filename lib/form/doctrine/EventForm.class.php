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
    $this->widgetSchema['date'] = new sfWidgetFormI18nDate(array(
      'format' => '%day%/%month%/%year%',
      'culture' => 'en'
    ));
    
    $this->widgetSchema['location'] = new sfWidgetFormInputText();
    $this->widgetSchema['woeid'] = new sfWidgetFormInputHidden();

    $this->validatorSchema['location'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['woeid'] = new sfValidatorInteger(array('required' => false));

    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkLocation')))
    );

    unset(
      $this['id'], $this['conference_id'], $this['tagline'], $this['description'], $this['hashtag'], $this['address'], $this['postcode'],
      $this['city_id'], $this['image'], $this['icon'],
      $this['attending_list'], $this['favouriters_list'], $this['organisers_list'], $this['speakers_list'], $this['watchers_list'],
      $this['created_at'], $this['updated_at']
    );
  }

  public function checkLocation($validator, $values) {
    $city = Doctrine::getTable('City')->findOneById($values['woeid']);

    if($city instanceOf City) {
      $this->getObject()->setCity($city);
    } else {
      if($values['location']) {
        $web = new sfWebBrowser();

        try {
          $web->get('http://query.yahooapis.com/v1/public/yql', array('q' => 'select * from geo.places where text = "'.$values['location'].'" and placetype = 7'));

          if (!$web->responseIsError()) {
            // Successful response (eg. 200, 201, etc)
            $places = array();
            
            foreach($web->getResponseXML()->results->place as $place) {
              $places[(int) $place->woeid] = $place->name.', '.$place->admin1.', '.$place->country;
            }

            $this->widgetSchema['woeid'] = new sfWidgetFormChoice(array(
              'choices' => $places
            ));
          } else {
            // Error response (eg. 404, 500, etc)
          }
        } catch (Exception $e) {
          // Adapter error (eg. Host not found)
        }
        
        throw new sfValidatorError($validator, 'required');
      }
    }

    // location is set, return the clean values
    return $values;
  }
}