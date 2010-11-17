<?php

/**
 * BaseFavouriter
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $event_id
 * 
 * @method integer    getUserId()   Returns the current record's "user_id" value
 * @method integer    getEventId()  Returns the current record's "event_id" value
 * @method Favouriter setUserId()   Sets the current record's "user_id" value
 * @method Favouriter setEventId()  Sets the current record's "event_id" value
 * 
 * @package    speakr
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFavouriter extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('favouriter');
        $this->hasColumn('user_id', 'integer', 20, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '20',
             ));
        $this->hasColumn('event_id', 'integer', 20, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '20',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}