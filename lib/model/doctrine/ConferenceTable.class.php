<?php

class ConferenceTable extends Doctrine_Table {
  public static function getInstance() {
    return Doctrine_Core::getTable('Conference');
  }

  public function search($keywords) {
    $q = Doctrine_Query::create()->from('Conference c');
    $q = $this->addSearchCriteria($q, 'c', $keywords);
    return $q->execute();
  }
  
  public function addSearchCriteria($q, $alias, $keywords) {
    return $q->
      orWhere($alias.'.name like ?', '%'.$keywords.'%')->
      orWhere($alias.'.slug like ?', '%'.$keywords.'%')->
      orWhere($alias.'.website like ?', '%'.$keywords.'%');
  }
}