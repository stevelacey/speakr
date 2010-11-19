<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'conference_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Conference'), 'add_empty' => false)),
      'tagline'          => new sfWidgetFormInputText(),
      'date'             => new sfWidgetFormDateTime(),
      'location_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => false)),
      'description'      => new sfWidgetFormInputText(),
      'url'              => new sfWidgetFormInputText(),
      'image'            => new sfWidgetFormInputText(),
      'icon'             => new sfWidgetFormInputText(),
      'hashtag'          => new sfWidgetFormInputText(),
      'address'          => new sfWidgetFormInputText(),
      'postcode'         => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'attending_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'favouriters_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'organisers_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'speakers_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'watchers_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'conference_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Conference'))),
      'tagline'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'date'             => new sfValidatorDateTime(),
      'location_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Location'))),
      'description'      => new sfValidatorString(array('max_length' => 255)),
      'url'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'icon'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'hashtag'          => new sfValidatorString(array('max_length' => 20)),
      'address'          => new sfValidatorString(array('max_length' => 255)),
      'postcode'         => new sfValidatorString(array('max_length' => 8)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'attending_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'favouriters_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'organisers_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'speakers_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'watchers_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['attending_list']))
    {
      $this->setDefault('attending_list', $this->object->Attending->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['favouriters_list']))
    {
      $this->setDefault('favouriters_list', $this->object->Favouriters->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['organisers_list']))
    {
      $this->setDefault('organisers_list', $this->object->Organisers->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['speakers_list']))
    {
      $this->setDefault('speakers_list', $this->object->Speakers->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['watchers_list']))
    {
      $this->setDefault('watchers_list', $this->object->Watchers->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveAttendingList($con);
    $this->saveFavouritersList($con);
    $this->saveOrganisersList($con);
    $this->saveSpeakersList($con);
    $this->saveWatchersList($con);

    parent::doSave($con);
  }

  public function saveAttendingList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['attending_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Attending->getPrimaryKeys();
    $values = $this->getValue('attending_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Attending', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Attending', array_values($link));
    }
  }

  public function saveFavouritersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['favouriters_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Favouriters->getPrimaryKeys();
    $values = $this->getValue('favouriters_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Favouriters', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Favouriters', array_values($link));
    }
  }

  public function saveOrganisersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['organisers_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Organisers->getPrimaryKeys();
    $values = $this->getValue('organisers_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Organisers', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Organisers', array_values($link));
    }
  }

  public function saveSpeakersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['speakers_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Speakers->getPrimaryKeys();
    $values = $this->getValue('speakers_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Speakers', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Speakers', array_values($link));
    }
  }

  public function saveWatchersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['watchers_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Watchers->getPrimaryKeys();
    $values = $this->getValue('watchers_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Watchers', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Watchers', array_values($link));
    }
  }

}
