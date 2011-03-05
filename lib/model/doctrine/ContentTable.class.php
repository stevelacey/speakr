<?php

class ContentTable extends Doctrine_Table {
  public static function getInstance() {
    return Doctrine_Core::getTable('Content');
  }

  public function search($keywords) {
    $q = Doctrine_Query::create()->
      from('Content c')->
      leftJoin('c.Presentations p')->
      leftJoin('p.Event e')->
      leftJoin('e.Conference ec')->
      leftJoin('p.PresentationUser pu')->
      leftJoin('pu.User u');

    $q = $this->addSearchCriteria($q, 'c', $keywords);
    $q = Doctrine::getTable('Event')->addSearchCriteria($q, 'e', $keywords);
    $q = Doctrine::getTable('Conference')->addSearchCriteria($q, 'ec', $keywords);
    $q = Doctrine::getTable('sfGuardUser')->addSearchCriteria($q, 'u', $keywords);

    return $q->execute();
  }

  public function addSearchCriteria($q, $alias, $keywords) {
    return $q->
      orWhere($alias.'.title like ?', '%'.$keywords.'%')->
      orWhere($alias.'.description like ?', '%'.$keywords.'%');
  }
}