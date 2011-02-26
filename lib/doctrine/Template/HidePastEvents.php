<?php

class Doctrine_Template_HidePastEvents extends Doctrine_Template
{
    /**
     * Array of HidePastEvents options
     *
     * @var string
     */
	  
    protected $_options = array('name'          =>  'end_at',
                                'type'          =>  'timestamp',
                                'length'        =>  '',
                                'options'       =>  array('default' => '',
                                                          'notnull' => true,
                                                          ),
    );

    /**
     * __construct
     *
     * @param string $array
     * @return void
     */
    public function __construct(array $options = array())
    {
        $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
    }

    /**
     * Set table definition for HidePastEvents behavior
     *
     * @return void
     */
    public function setTableDefinition()
    {
        $this->hasColumn($this->_options['name'], $this->_options['type'], $this->_options['length'], $this->_options['options']);

        $this->addListener(new Doctrine_Template_Listener_HidePastEvents($this->_options));
    }

    /**
     * @nodoc
     */
    public function getOption($name, $default = null)
    {
        return $this->_options[$name];
    }
}