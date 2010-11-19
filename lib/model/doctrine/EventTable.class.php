<?php

class EventTable extends Doctrine_Table {
  public static function getInstance() {
    return Doctrine_Core::getTable('Event');
  }

  public function getUpcoming() {
    return Doctrine_Query::create()->
      from('Event e')->
      where('e.date >= ?', date('Y-m-d'))->
      andWhere('e.date <= ?', date('Y-m-d', strtotime('+1 Year')))->
      execute();
  }

  public function findBySlug($params) {
    return Doctrine_Query::create()->
      from('Event e')->
      leftJoin('e.Conference c')->
      where('concat_ws("-", c.slug, year(e.date)) = ?', $params['slug'])->
      fetchOne();
  }
}