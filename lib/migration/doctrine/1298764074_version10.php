<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version10 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->renameColumn('event', 'date', 'start_at');
        $this->addColumn('event', 'end_at', 'timestamp', '25', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {
        $this->renameeColumn('event', 'start_at', 'date');
        $this->removeColumn('event', 'end_at');
    }
}