<?php

/**
 * Presentation form base class.
 *
 * @method Presentation getObject() Returns the current form's model object
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePresentationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'event_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => true)),
      'content_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Content'), 'add_empty' => true)),
      'presenters_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'event_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'required' => false)),
      'content_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Content'), 'required' => false)),
      'presenters_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Presentation', 'column' => array('event_id', 'content_id')))
    );

    $this->widgetSchema->setNameFormat('presentation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Presentation';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['presenters_list']))
    {
      $this->setDefault('presenters_list', $this->object->Presenters->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePresentersList($con);

    parent::doSave($con);
  }

  public function savePresentersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['presenters_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Presenters->getPrimaryKeys();
    $values = $this->getValue('presenters_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Presenters', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Presenters', array_values($link));
    }
  }

}
