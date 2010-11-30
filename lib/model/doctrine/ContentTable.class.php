<?php

class ContentTable extends Doctrine_Table {
  public static function getInstance() {
    return Doctrine_Core::getTable('Content');
  }

  public function findBySpeakerSlugAndSlug($params) {
    return Doctrine_Query::create()->
      select('*, GROUP_CONCAT(DISTINCT(u.username) ORDER BY u.username ASC SEPARATOR "-and-") as ss')->
      from('Content c')->
      leftJoin('c.Presentations p')->
      leftJoin('p.PresentationUser pu')->
      leftJoin('pu.User u')->
      having('ss = ?', $params['speaker_slug'])->
      andWhere('c.slug = ?', $params['slug'])->
      fetchOne();
  }
}