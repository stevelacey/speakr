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

  public function search($keywords) {
    $q = Doctrine_Query::create()->from('sfGuardUser u');
    $q = $this->addSearchCriteria($q, 'u', $keywords);
    return $q->execute();
  }
  
  public function addSearchCriteria($q, $alias, $keywords) {
    return $q->
      orWhere($alias.'.username like ?', '%'.$keywords.'%')->
      orWhere('concat_ws(" ", '.$alias.'.first_name, '.$alias.'.last_name) like ?', '%'.$keywords.'%');
  }
}