<?php

/**
 * Presentation form.
 *
 * @package    speakr
 * @subpackage form
 * @author     Steve Lacey
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PresentationForm extends BasePresentationForm {
  public function configure() {
    if(!$event = $this->getOption('event')) {
      throw new InvalidArgumentException('You must provide a event object.');
    }

    $this->getObject()->setEvent($event);

    if($content = $this->getOption('content')) {
      $this->getObject()->setContent($content);
    }

    $this->embedForm('content', new ContentForm($this->getObject()->getContent()));

    $this->widgetSchema['speakers_list'] = new sfWidgetFormDoctrineChoice(array(
      'label' => 'Presented by',
      'model' => 'sfGuardUser',
      'query' => $this->getOption('event')->getSpeakersQuery(),
      'multiple' => true,
      'expanded' => true
    ));

    $this->validatorSchema['speakers_list'] = new sfValidatorChoice(array(
      'choices' => $this->getOption('event')->getSpeakersIds(),
      'multiple' => true
    ));

    unset($this['event_id'], $this['content_id']);
  }
}