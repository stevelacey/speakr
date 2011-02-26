<?php

class EventTable extends Doctrine_Table {
  public static function getInstance() {
    return Doctrine_Core::getTable('Event');
  }

  public function findByUserFollowing(sfGuardUser $user) {
    return Doctrine_Query::create()->
      from('Event e')->

      leftJoin('e.Attendee a on a.event_id = e.id')->
      leftJoin('a.User au')->
      leftJoin('au.Friend fa on fa.following_id = a.user_id')->

      leftJoin('e.Speaker s on s.event_id = e.id')->
      leftJoin('s.User su')->
      leftJoin('su.Friend fs on fs.following_id =  s.user_id')->

      orWhere('fa.follower_id = ?', $user->getId())->
      orWhere('fs.follower_id = ?', $user->getId())->

      groupBy('e.id')->
      execute();
  }

  public function getUpcoming() {
    return Doctrine_Query::create()->
      from('Event e')->
      where('e.start_at >= ?', date('Y-m-d'))->
      andWhere('e.start_at <= ?', date('Y-m-d', strtotime('+1 Year')))->
      execute();
  }

  public function findBySlug($params) {
    return Doctrine_Query::create()->
      from('Event e')->
      leftJoin('e.Conference c')->
      where('concat_ws("-", c.slug, year(e.start_at)) = ?', $params['slug'])->
      fetchOne();
  }
}