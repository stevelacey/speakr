<?php

/**
 * Speaker form base class.
 *
 * @method Speaker getObject() Returns the current form's model object
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSpeakerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'  => new sfWidgetFormInputHidden(),
      'event_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'user_id', 'required' => false)),
      'event_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'event_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('speaker[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Speaker';
  }

}
