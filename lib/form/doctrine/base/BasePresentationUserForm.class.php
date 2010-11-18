<?php

/**
 * PresentationUser form base class.
 *
 * @method PresentationUser getObject() Returns the current form's model object
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePresentationUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'presentation_id' => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'presentation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'presentation_id', 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'user_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('presentation_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PresentationUser';
  }

}
