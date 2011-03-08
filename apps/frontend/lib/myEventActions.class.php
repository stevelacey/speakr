<?php

/**
 * event actions.
 *
 * @package    speakr
 * @subpackage event
 * @author     Steve Lacey
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myEventActions extends myActions {
  public function executeAttend(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'attend', $request->getParameter('verb') == 'do');
  }

  public function executeFavourite(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'favourite', $request->getParameter('verb') == 'do');
  }

  public function executeOrganise(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'organise', $request->getParameter('verb') == 'do');
  }

  public function executeSpeak(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'speak', $request->getParameter('verb') == 'do');
  }

  public function executeWatch(sfWebRequest $request) {
    $this->go($request, $this->getUser()->getGuardUser(), 'watch', $request->getParameter('verb') == 'do');
  }

  public function executeAddSpeaker(sfWebRequest $request) {
    $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username'));

    if(!$user instanceOf sfGuardUser) {
      $xml = Twitter::getConnection()->get('users/show', array('screen_name' => $request->getParameter('username')));

      if(isset($xml->id)) {
        $user = new sfGuardUser();
        $user->setId((int) $xml->id);
        $user->setUsername($xml->screen_name);
        $user->setEmailAddress($xml->screen_name);
        $user->setPassword($this->generatePassword());

        if(stristr($xml->name, ' ')) {
          $user->setFirstName(substr($xml->name, 0, strpos($xml->name, ' ')));
          $user->setLastName(substr($xml->name, strpos($xml->name, ' ') + 1, strlen($xml->name)));
        } else {
          $user->setFirstName($xml->name);
        }

        $profile = new sfGuardUserProfile();
        $profile->setId((int) $xml->id);
        $profile->setDescription($xml->description);
        $profile->setWebsite($xml->url);
        $profile->setImage($xml->profile_image_url);

        $user->setProfile($profile);
        $user->save();
      }
    }

    if($user instanceOf sfGuardUser) {
      $this->go($request, $user, 'speak', true);
    } else {
      $this->redirect('speakers', $this->getRoute()->getObject());
    }
  }

  public function executeRemoveSpeaker(sfWebRequest $request) {
    $user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username'));
    
    if($user instanceOf sfGuardUser) {
      $this->go($request, $user, 'speak', false);
    }
  }

  public function go(sfWebRequest $request, $user, $relation, $action) {
//    $request->checkCSRFProtection();
    call_user_func_array(array($user, $relation), array($this->getRoute()->getObject(), $action));
    $this->redirect($this->getUser()->getReferer($request->getReferer()));
  }

  private function generatePassword() {
    // Set a secure, random sfGuard password to ensure that this
    // account is not wide open if conventional logins are permitted
    $guid = '';

    for ($i = 0; ($i < 8); $i++) {
      $guid .= sprintf("%x", mt_rand(0, 15));
    }

    return $guid;
  }
}