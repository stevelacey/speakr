<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration {
  public function setup() {
    $this->enableAllPluginsExcept('sfPropelPlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
  }

  public function getEnvironment() {
    if(stristr($_SERVER['HTTP_HOST'], 'www.speakr.co.uk' )) {
      return 'live';
    } else if(stristr($_SERVER['HTTP_HOST'], 'dev.speakr.co.uk' )) {
      return 'demo';
    } else {
      return 'dev';
    }
  }
}
