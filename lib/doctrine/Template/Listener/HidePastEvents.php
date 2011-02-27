<?php

class Doctrine_Template_Listener_HidePastEvents extends Doctrine_Record_Listener {
    /**
     * Array of HidePastEvents options
     *
     * @var string
     */
    protected $_options = array();

    /**
     * __construct
     *
     * @param string $options 
     * @return void
     */
    public function __construct(array $options)
    {
        $this->_options = $options;
    }
    
    /**
     * Implement preDqlSelect() hook and add the hide unpublished flag to all queries for which this model 
     * is being used in.
     *
     * @param Doctrine_Event $event 
     * @return void
     */
    public function preDqlSelect(Doctrine_Event $event)
    {
        $params = $event->getParams();
        $field = $params['alias'] . '.' . $this->_options['name'];
        $query = $event->getQuery();
        if ( ! $query->contains($field)) {
            $query->addWhere(
              $field . ' > FROM_UNIXTIME(' . mktime(date('H')+1, 0, 0) . ')'
            )->addOrderBy($field . ' DESC');
        }
    }
}