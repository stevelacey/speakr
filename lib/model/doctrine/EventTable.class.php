<?php

class EventTable extends Doctrine_Table {
  public static function getInstance() {
    return Doctrine_Core::getTable('Event');
  }

  public function findByUser(sfGuardUser $user) {
    return Doctrine_query::create()->
      from('Event e')->
      leftJoin('e.Attendee a on a.event_id = e.id')->
      leftJoin('e.Organiser o on o.event_id = e.id')->
      leftJoin('e.Speaker s on s.event_id = e.id')->

      where('a.user_id = ? or o.user_id = ? or s.user_id = ?', array($user->getId(), $user->getId(), $user->getId()))->
      andWhere('e.end_at >= ?', date('Y-m-d'))->

      groupBy('e.id')->
      execute();
  }

  public function findByUserFollowing(sfGuardUser $user) {
    return Doctrine_Query::create()->
      from('Event e')->

      leftJoin('e.Attendee a on a.event_id = e.id')->
      leftJoin('a.User au')->
      leftJoin('au.Friend fa on fa.following_id = a.user_id')->

      leftJoin('e.Organiser o on a.event_id = e.id')->
      leftJoin('o.User ou')->
      leftJoin('ou.Friend fo on fo.following_id = o.user_id')->

      leftJoin('e.Speaker s on s.event_id = e.id')->
      leftJoin('s.User su')->
      leftJoin('su.Friend fs on fs.following_id =  s.user_id')->

      where('fa.follower_id = ? or fo.follower_id = ? or fs.follower_id = ?', array($user->getId(), $user->getId(), $user->getId()))->
      andWhere('e.end_at >= ?', date('Y-m-d'))->

      groupBy('e.id')->
      execute();
  }

  public function findFutureEventsByUserRelation(sfGuardUser $user, $relation) {
    return Doctrine_Query::create()->
      from('Event e')->
      leftJoin('e.'.$relation.' '.substr($relation, 0, 1).' on '.substr($relation, 0, 1).'.event_id = e.id')->
      where(substr($relation, 0, 1).'.user_id = ?', $user->getId())->
      andWhere('e.end_at >= ?', date('Y-m-d'))->
      execute();
  }

  public function findPastEventsByUserRelation(sfGuardUser $user, $relation) {
    return Doctrine_Query::create()->
      from('Event e')->
      leftJoin('e.'.$relation.' '.substr($relation, 0, 1).' on '.substr($relation, 0, 1).'.event_id = e.id')->
      where(substr($relation, 0, 1).'.user_id = ?', $user->getId())->
      andWhere('e.end_at < ?', date('Y-m-d'))->
      orderBy('e.end_at desc')->
      execute();
  }

  public function getUpcoming() {
    return Doctrine_Query::create()->
      from('Event e')->
      where('e.end_at >= ?', date('Y-m-d'))->
      andWhere('e.end_at <= ?', date('Y-m-d', strtotime('+1 Year')))->
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