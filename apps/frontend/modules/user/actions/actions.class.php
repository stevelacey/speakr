<?php

class userActions extends sfActions {
  public function executeShow(sfWebRequest $request) {
    $this->user = $this->getRoute()->getObject();
  }

  public function executeSearch(sfWebRequest $request) {
    $users = array();

    if($request->hasParameter('query')) {
      foreach(Doctrine::getTable('sfGuardUser')->search($request->getParameter('query')) as $user) {
        $users[] = array(
          'username' => $user->getUsername(),
          'name' => $user->getName(),
          'image' => $user->getImage()
        );
      }
    }
    
    return $this->renderText(json_encode($users));
  }

  public function executeEdit(sfWebRequest $request) {
    $this->user = $this->getUser()->getGuardUser();
    $this->form = new sfGuardUserForm($this->user);
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->user = $this->getUser()->getGuardUser();
    $this->form = new sfGuardUserForm($this->user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $user = $form->save();
      $this->redirect(url_for('account/profile', $user));
    }
  }
}