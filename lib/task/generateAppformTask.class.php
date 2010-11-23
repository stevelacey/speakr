<?php

class generateAppformTask extends sfBaseTask
{
  protected function configure()
  {
    // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'The application name'),
      new sfCommandArgument('model', sfCommandArgument::REQUIRED, 'The model name'),
    ));

    $this->addOptions(array(
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      // add your own options here
    ));

    $this->namespace        = 'generate';
    $this->name             = 'app-form';
    $this->briefDescription = 'Generates app specific form extension classes';
    $this->detailedDescription = <<<EOF
The [generate:app-form|INFO] generates form extensions for frontent/backend use.
Call it with:

  [php symfony generate:app-form|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {

    // add your code here
    $manager = new sfGeneratorManager($this->configuration);
    $generator = new myAppFormGenerator($manager);
    $generator->generate(array('app'=> $arguments['application'], 'model'=>$arguments['model']));
    $this->logSection('task', sprintf('Creating "%s" form for %s app', $arguments['model'], $arguments['application']));
  }
}