[?php

/**
 * <?php echo $this->params['app'] ?><?php echo $this->params['model'] ?> form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class <?php echo $this->params['app'] ?><?php echo $this->params['model'] ?>Form extends <?php echo $this->params['model'] ?>Form
{

  public function configure()
  {
    parent::configure();
  }

  protected function removeFields() {
    parent::removeFields();
  }

  protected function configureHelps() {
    parent::configureHelps();
  }

  protected function configureLabels() {
    parent::configureLabels();
  }

  protected function configureWidgets() {
    parent::configureWidgets();
  }

  protected function configureValidators() {
    parent::configureValidators();
  }

  protected function arrangeFields() {
    parent::arrangeFields();
  }

}