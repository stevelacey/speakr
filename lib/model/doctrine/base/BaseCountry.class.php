<?php

/**
 * BaseCountry
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Locations
 * 
 * @method string              getName()      Returns the current record's "name" value
 * @method Doctrine_Collection getLocations() Returns the current record's "Locations" collection
 * @method Country             setName()      Sets the current record's "name" value
 * @method Country             setLocations() Sets the current record's "Locations" collection
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCountry extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('country');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Location as Locations', array(
             'local' => 'id',
             'foreign' => 'country_id'));

        $sluggable0 = new Doctrine_Template_Sluggable();
        $this->actAs($sluggable0);
    }
}