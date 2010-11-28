<?php

class GoogleMapsAPI {
  private $web;
  private $defaults = array(
    'sensor' => 'false'
  );

  public function __construct() {
    $this->web = new sfWebBrowser();
  }

  public function __call($method, $arguments) {
    $url = sfConfig::get('app_google_api_url').'/'.$method.'/'.sfConfig::get('app_google_api_default_format');

    $params = array_merge($this->defaults, current($arguments));

    ksort($params);

    foreach($params as $key => $value) {
      $params[$key] = $key.'='.urlencode($value);
    }

    $url .= '?'.implode('&', $params);
    
    return json_decode($this->web->get($url)->getResponseText());
  }
}