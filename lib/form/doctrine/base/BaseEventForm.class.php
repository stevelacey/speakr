<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    speakr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'conference_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Conference'), 'add_empty' => false)),
      'location_id'   => new sfWidgetFormInputText(),
      'title'         => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
      'url'           => new sfWidgetFormInputText(),
      'hashtag'       => new sfWidgetFormInputText(),
      'address'       => new sfWidgetFormInputText(),
      'postcode'      => new sfWidgetFormInputText(),
      'slug'          => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'conference_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Conference'))),
      'location_id'   => new sfValidatorInteger(),
      'title'         => new sfValidatorString(array('max_length' => 255)),
      'description'   => new sfValidatorString(array('max_length' => 255)),
      'url'           => new sfValidatorString(array('max_length' => 255)),
      'hashtag'       => new sfValidatorString(array('max_length' => 20)),
      'address'       => new sfValidatorString(array('max_length' => 255)),
      'postcode'      => new sfValidatorString(array('max_length' => 8)),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Event', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
