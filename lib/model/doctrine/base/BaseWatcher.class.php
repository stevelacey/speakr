<?php

/**
 * BaseWatcher
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $event_id
 * @property Event $Event
 * @property sfGuardUser $User
 * 
 * @method integer     getUserId()   Returns the current record's "user_id" value
 * @method integer     getEventId()  Returns the current record's "event_id" value
 * @method Event       getEvent()    Returns the current record's "Event" value
 * @method sfGuardUser getUser()     Returns the current record's "User" value
 * @method Watcher     setUserId()   Sets the current record's "user_id" value
 * @method Watcher     setEventId()  Sets the current record's "event_id" value
 * @method Watcher     setEvent()    Sets the current record's "Event" value
 * @method Watcher     setUser()     Sets the current record's "User" value
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWatcher extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('watcher');
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
        $this->hasOne('Event', array(
             'local' => 'event_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));
    }
}