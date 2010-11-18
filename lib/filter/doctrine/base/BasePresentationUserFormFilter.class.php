<?php

/**
 * PresentationUser filter form base class.
 *
 * @package    speakr
 * @subpackage filter
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePresentationUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('presentation_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PresentationUser';
  }

  public function getFields()
  {
    return array(
      'presentation_id' => 'Number',
      'user_id'         => 'Number',
    );
  }
}
