<?php

/**
 * BaseConference
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property Doctrine_Collection $Event
 * 
 * @method string              getTitle() Returns the current record's "title" value
 * @method Doctrine_Collection getEvent() Returns the current record's "Event" collection
 * @method Conference          setTitle() Sets the current record's "title" value
 * @method Conference          setEvent() Sets the current record's "Event" collection
 * 
 * @package    speakr
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConference extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('conference');
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Event', array(
             'local' => 'id',
             'foreign' => 'conference_id'));

        $sluggable0 = new Doctrine_Template_Sluggable();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($sluggable0);
        $this->actAs($timestampable0);
    }
}