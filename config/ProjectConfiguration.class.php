<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration {
  public function setup() {
    $this->enableAllPluginsExcept('sfPropelPlugin');
  }

  public function getEnvironment() {
    if(strpos($_SERVER['HTTP_HOST'], 'i7.stevelacey.net' ) !== false) {
      return 'dev';
    } else if(strpos($_SERVER['HTTP_HOST'], 'dev.speakr.co.uk' ) !== false) {
      return 'demo';
    } else {
      return 'live';
    }
  }
}