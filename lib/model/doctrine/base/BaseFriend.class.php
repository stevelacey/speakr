<?php

/**
 * BaseFriend
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $follower_id
 * @property integer $following_id
 * @property sfGuardUser $Follower
 * @property sfGuardUser $Following
 * 
 * @method integer     getFollowerId()   Returns the current record's "follower_id" value
 * @method integer     getFollowingId()  Returns the current record's "following_id" value
 * @method sfGuardUser getFollower()     Returns the current record's "Follower" value
 * @method sfGuardUser getFollowing()    Returns the current record's "Following" value
 * @method Friend      setFollowerId()   Sets the current record's "follower_id" value
 * @method Friend      setFollowingId()  Sets the current record's "following_id" value
 * @method Friend      setFollower()     Sets the current record's "Follower" value
 * @method Friend      setFollowing()    Sets the current record's "Following" value
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFriend extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('friend');
        $this->hasColumn('follower_id', 'integer', 20, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '20',
             ));
        $this->hasColumn('following_id', 'integer', 20, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '20',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Follower', array(
             'local' => 'follower_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as Following', array(
             'local' => 'following_id',
             'foreign' => 'id'));
    }
}