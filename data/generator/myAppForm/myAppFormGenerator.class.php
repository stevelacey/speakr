<?php

class myAppFormGenerator extends sfGenerator {

  /**
   * Initializes the current sfGenerator instance.
   *
   * @param sfGeneratorManager A sfGeneratorManager instance
   */
  public function initialize(sfGeneratorManager $generatorManager) {
    parent::initialize($generatorManager);

    $this->setGeneratorClass('myAppForm');
  }

  /**
   * Generates classes and templates in cache.
   *
   * @param array The parameters
   *
   * @return string The data to put in configuration cache
   */
  public function generate($params = array()) {
    $this->params = $params;

    $baseDir = sfConfig::get('sf_lib_dir') . '/form/doctrine';

    if (!file_exists($classFile = $baseDir.'/'.$params['app'].$params['model'].'Form.class.php')) {
      file_put_contents($classFile, $this->evalTemplate('myAppFormTemplate.php'));
    }

  }
}