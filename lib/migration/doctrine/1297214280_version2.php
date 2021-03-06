<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version2 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('friend', 'friend_follower_id_sf_guard_user_id', array(
             'name' => 'friend_follower_id_sf_guard_user_id',
             'local' => 'follower_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->createForeignKey('friend', 'friend_following_id_sf_guard_user_id', array(
             'name' => 'friend_following_id_sf_guard_user_id',
             'local' => 'following_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->addIndex('friend', 'friend_follower_id', array(
             'fields' => 
             array(
              0 => 'follower_id',
             ),
             ));
        $this->addIndex('friend', 'friend_following_id', array(
             'fields' => 
             array(
              0 => 'following_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('friend', 'friend_follower_id_sf_guard_user_id');
        $this->dropForeignKey('friend', 'friend_following_id_sf_guard_user_id');
        $this->removeIndex('friend', 'friend_follower_id', array(
             'fields' => 
             array(
              0 => 'follower_id',
             ),
             ));
        $this->removeIndex('friend', 'friend_following_id', array(
             'fields' => 
             array(
              0 => 'following_id',
             ),
             ));
    }
}