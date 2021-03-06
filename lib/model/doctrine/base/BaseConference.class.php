<?php

/**
 * BaseConference
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $website
 * @property string $image
 * @property string $icon
 * @property Doctrine_Collection $Events
 * 
 * @method string              getName()    Returns the current record's "name" value
 * @method string              getWebsite() Returns the current record's "website" value
 * @method string              getImage()   Returns the current record's "image" value
 * @method string              getIcon()    Returns the current record's "icon" value
 * @method Doctrine_Collection getEvents()  Returns the current record's "Events" collection
 * @method Conference          setName()    Sets the current record's "name" value
 * @method Conference          setWebsite() Sets the current record's "website" value
 * @method Conference          setImage()   Sets the current record's "image" value
 * @method Conference          setIcon()    Sets the current record's "icon" value
 * @method Conference          setEvents()  Sets the current record's "Events" collection
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConference extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('conference');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('website', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('image', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('icon', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));

        $this->option('orderBy', 'name ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Event as Events', array(
             'local' => 'id',
             'foreign' => 'conference_id'));

        $sluggable0 = new Doctrine_Template_Sluggable();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($sluggable0);
        $this->actAs($timestampable0);
    }
}