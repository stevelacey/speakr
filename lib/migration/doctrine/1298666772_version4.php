<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version4 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->renameColumn('conference', 'url', 'website');
        $this->renameColumn('event', 'url', 'website');
    }

    public function down()
    {
        $this->renameColumn('conference', 'website', 'url');
        $this->renameColumn('event', 'website', 'url');
    }
}