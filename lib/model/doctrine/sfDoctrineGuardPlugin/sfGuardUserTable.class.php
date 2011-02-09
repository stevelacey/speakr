<?php

class sfGuardUserTable extends PluginsfGuardUserTable {
  public static function getInstance() {
    return Doctrine_Core::getTable('sfGuardUser');
  }

  public function findByIds($ids) {
    return Doctrine_Query::create()->
      from('sfGuardUser u')->
      whereIn('u.id', $ids)->
      execute();
  }

  public function search($query) {
    return Doctrine_Query::create()->
      from('sfGuardUser u')->
      where('u.username like ?', '%'.$query.'%')->
      orWhere('concat_ws(" ", u.first_name, u.last_name) like ?', '%'.$query.'%')->
      execute();
  }
}