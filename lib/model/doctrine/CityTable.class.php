<?php

class CityTable extends Doctrine_Table {

  public static function getInstance() {
    return Doctrine_Core::getTable('City');
  }

  public function findOneById($id) {
    $city = Doctrine_Query::create()->
      from('City')->
      where('id = ?', $id)->
      fetchOne();
    
    if (!$city instanceOf City) {
      $web = new sfWebBrowser();

      try {
        if (!$web->get('http://query.yahooapis.com/v1/public/yql', array('q' => 'select * from geo.places where woeid = '.$id))->responseIsError()) {
          // Successful response (eg. 200, 201, etc)

          if($web->getResponseXML()->results->place->placeTypeName->attributes()->code == 7 /* City/Town */) {
            $city = new City();
            $city->setId((int) $web->getResponseXML()->results->place->woeid);
            $city->setName($web->getResponseXML()->results->place->name);

            try {
              if (!$web->get('http://query.yahooapis.com/v1/public/yql', array('q' => 'select * from geo.places.ancestors where descendant_woeid = '.$id))->responseIsError()) {
                // Successful response (eg. 200, 201, etc)

                foreach($web->getResponseXML()->results->place as $place) {
                  switch($place->placeTypeName->attributes()->code) {
                    case 8: // One of the primary administrative areas within a country. Place type names associated with this place type include: State, Province, Prefecture, Country, Region, Federal District.
                      $region = Doctrine::getTable('Region')->findOneById($place->woeid);

                      if(!$region instanceOf Region) {
                        $region = new Region();
                        $region->setId((int) $place->woeid);
                        $region->setName($place->name);
                      }

                      break;
                    case 12: // One of the countries and dependent territories defined by the ISO 3166-1 standard.
                      $country = Doctrine::getTable('Country')->findOneById($place->woeid);

                      if(!$country instanceOf Country) {
                        $country = new Country();
                        $country->setId((int) $place->woeid);
                        $country->setName($place->name);
                      }
                  }
                }

                if($city instanceOf City && $region instanceOf Region && $country instanceOf Country) {
                  $city->setRegion($region);
                  $region->setCountry($country);

                  return $city;
                }

              } else {
                // Error response (eg. 404, 500, etc)
              }
            } catch (Exception $e) {
              // Adapter error (eg. Host not found)
            }

          }
        } else {
          // Error response (eg. 404, 500, etc)
        }
      } catch (Exception $e) {
        // Adapter error (eg. Host not found)
      }
    } else {
      return $city;
    }
  }
}