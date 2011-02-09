<?php

/**
 * Friend form base class.
 *
 * @method Friend getObject() Returns the current form's model object
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFriendForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'follower_id'  => new sfWidgetFormInputHidden(),
      'following_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'follower_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'follower_id', 'required' => false)),
      'following_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'following_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('friend[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friend';
  }

}
