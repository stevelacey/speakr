<?php

/**
 * Event filter form base class.
 *
 * @package    speakr
 * @subpackage filter
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'conference_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Conference'), 'add_empty' => true)),
      'tagline'          => new sfWidgetFormFilterInput(),
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'location_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => true)),
      'description'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'              => new sfWidgetFormFilterInput(),
      'image'            => new sfWidgetFormFilterInput(),
      'icon'             => new sfWidgetFormFilterInput(),
      'hashtag'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'postcode'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'attending_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'favouriters_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'organisers_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'speakers_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'watchers_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'conference_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Conference'), 'column' => 'id')),
      'tagline'          => new sfValidatorPass(array('required' => false)),
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'location_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Location'), 'column' => 'id')),
      'description'      => new sfValidatorPass(array('required' => false)),
      'url'              => new sfValidatorPass(array('required' => false)),
      'image'            => new sfValidatorPass(array('required' => false)),
      'icon'             => new sfValidatorPass(array('required' => false)),
      'hashtag'          => new sfValidatorPass(array('required' => false)),
      'address'          => new sfValidatorPass(array('required' => false)),
      'postcode'         => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'attending_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'favouriters_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'organisers_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'speakers_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'watchers_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addAttendingListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.Attendee Attendee')
          ->andWhereIn('Attendee.user_id', $values);
  }

  public function addFavouritersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.Favouriter Favouriter')
          ->andWhereIn('Favouriter.user_id', $values);
  }

  public function addOrganisersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.Organiser Organiser')
          ->andWhereIn('Organiser.user_id', $values);
  }

  public function addSpeakersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.Speaker Speaker')
          ->andWhereIn('Speaker.user_id', $values);
  }

  public function addWatchersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.Watcher Watcher')
          ->andWhereIn('Watcher.user_id', $values);
  }

  public function getModelName()
  {
    return 'Event';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'conference_id'    => 'ForeignKey',
      'tagline'          => 'Text',
      'date'             => 'Date',
      'location_id'      => 'ForeignKey',
      'description'      => 'Text',
      'url'              => 'Text',
      'image'            => 'Text',
      'icon'             => 'Text',
      'hashtag'          => 'Text',
      'address'          => 'Text',
      'postcode'         => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'attending_list'   => 'ManyKey',
      'favouriters_list' => 'ManyKey',
      'organisers_list'  => 'ManyKey',
      'speakers_list'    => 'ManyKey',
      'watchers_list'    => 'ManyKey',
    );
  }
}
