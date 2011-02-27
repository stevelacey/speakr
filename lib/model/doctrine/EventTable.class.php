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

      orWhere('a.user_id = ?', $user->getId())->
      orWhere('o.user_id = ?', $user->getId())->
      orWhere('s.user_id = ?', $user->getId())->

      groupBy('e.id')->
      orderBy('e.start_at', 'asc')->
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

      orWhere('fa.follower_id = ?', $user->getId())->
      orWhere('fo.follower_id = ?', $user->getId())->
      orWhere('fs.follower_id = ?', $user->getId())->

      groupBy('e.id')->
      orderBy('e.start_at', 'asc')->
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