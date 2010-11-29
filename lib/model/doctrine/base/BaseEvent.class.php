<?php

/**
 * BaseEvent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $conference_id
 * @property string $tagline
 * @property timestamp $date
 * @property integer $location_id
 * @property string $description
 * @property string $url
 * @property string $image
 * @property string $icon
 * @property string $hashtag
 * @property string $address
 * @property string $postcode
 * @property Conference $Conference
 * @property Location $Location
 * @property Doctrine_Collection $Attending
 * @property Doctrine_Collection $Favouriters
 * @property Doctrine_Collection $Organisers
 * @property Doctrine_Collection $Speakers
 * @property Doctrine_Collection $Watcher
 * 
 * @method integer             getConferenceId()  Returns the current record's "conference_id" value
 * @method string              getTagline()       Returns the current record's "tagline" value
 * @method timestamp           getDate()          Returns the current record's "date" value
 * @method integer             getLocationId()    Returns the current record's "location_id" value
 * @method string              getDescription()   Returns the current record's "description" value
 * @method string              getUrl()           Returns the current record's "url" value
 * @method string              getImage()         Returns the current record's "image" value
 * @method string              getIcon()          Returns the current record's "icon" value
 * @method string              getHashtag()       Returns the current record's "hashtag" value
 * @method string              getAddress()       Returns the current record's "address" value
 * @method string              getPostcode()      Returns the current record's "postcode" value
 * @method Conference          getConference()    Returns the current record's "Conference" value
 * @method Location            getLocation()      Returns the current record's "Location" value
 * @method Doctrine_Collection getAttending()     Returns the current record's "Attending" collection
 * @method Doctrine_Collection getFavouriters()   Returns the current record's "Favouriters" collection
 * @method Doctrine_Collection getOrganisers()    Returns the current record's "Organisers" collection
 * @method Doctrine_Collection getSpeakers()      Returns the current record's "Speakers" collection
 * @method Doctrine_Collection getWatchers()      Returns the current record's "Watchers" collection
 * @method Doctrine_Collection getPresentations() Returns the current record's "Presentations" collection
 * @method Doctrine_Collection getAttendee()      Returns the current record's "Attendee" collection
 * @method Doctrine_Collection getFavouriter()    Returns the current record's "Favouriter" collection
 * @method Doctrine_Collection getOrganiser()     Returns the current record's "Organiser" collection
 * @method Doctrine_Collection getSpeaker()       Returns the current record's "Speaker" collection
 * @method Doctrine_Collection getWatcher()       Returns the current record's "Watcher" collection
 * @method Event               setConferenceId()  Sets the current record's "conference_id" value
 * @method Event               setTagline()       Sets the current record's "tagline" value
 * @method Event               setDate()          Sets the current record's "date" value
 * @method Event               setLocationId()    Sets the current record's "location_id" value
 * @method Event               setDescription()   Sets the current record's "description" value
 * @method Event               setUrl()           Sets the current record's "url" value
 * @method Event               setImage()         Sets the current record's "image" value
 * @method Event               setIcon()          Sets the current record's "icon" value
 * @method Event               setHashtag()       Sets the current record's "hashtag" value
 * @method Event               setAddress()       Sets the current record's "address" value
 * @method Event               setPostcode()      Sets the current record's "postcode" value
 * @method Event               setConference()    Sets the current record's "Conference" value
 * @method Event               setLocation()      Sets the current record's "Location" value
 * @method Event               setAttending()     Sets the current record's "Attending" collection
 * @method Event               setFavouriters()   Sets the current record's "Favouriters" collection
 * @method Event               setOrganisers()    Sets the current record's "Organisers" collection
 * @method Event               setSpeakers()      Sets the current record's "Speakers" collection
 * @method Event               setWatchers()      Sets the current record's "Watchers" collection
 * @method Event               setPresentations() Sets the current record's "Presentations" collection
 * @method Event               setAttendee()      Sets the current record's "Attendee" collection
 * @method Event               setFavouriter()    Sets the current record's "Favouriter" collection
 * @method Event               setOrganiser()     Sets the current record's "Organiser" collection
 * @method Event               setSpeaker()       Sets the current record's "Speaker" collection
 * @method Event               setWatcher()       Sets the current record's "Watcher" collections
 * @property Doctrine_Collection $Presentations
 * @property Doctrine_Collection $Attendee
 * @property Doctrine_Collection $Favouriter
 * @property Doctrine_Collection $Organiser
 * @property Doctrine_Collection $Speaker
 * @property Doctrine_Collection $Watcher
 * 
 * @method integer             getConferenceId()  Returns the current record's "conference_id" value
 * @method string              getTagline()       Returns the current record's "tagline" value
 * @method timestamp           getDate()          Returns the current record's "date" value
 * @method integer             getLocationId()    Returns the current record's "location_id" value
 * @method string              getDescription()   Returns the current record's "description" value
 * @method string              getUrl()           Returns the current record's "url" value
 * @method string              getImage()         Returns the current record's "image" value
 * @method string              getIcon()          Returns the current record's "icon" value
 * @method string              getHashtag()       Returns the current record's "hashtag" value
 * @method string              getAddress()       Returns the current record's "address" value
 * @method string              getPostcode()      Returns the current record's "postcode" value
 * @method Conference          getConference()    Returns the current record's "Conference" value
 * @method Location            getLocation()      Returns the current record's "Location" value
 * @method Doctrine_Collection getAttending()     Returns the current record's "Attending" collection
 * @method Doctrine_Collection getFavouriters()   Returns the current record's "Favouriters" collection
 * @method Doctrine_Collection getOrganisers()    Returns the current record's "Organisers" collection
 * @method Doctrine_Collection getSpeakers()      Returns the current record's "Speakers" collection
 * @method Doctrine_Collection getWatchers()      Returns the current record's "Watchers" collection
 * @method Doctrine_Collection getPresentations() Returns the current record's "Presentations" collection
 * @method Doctrine_Collection getAttendee()      Returns the current record's "Attendee" collection
 * @method Doctrine_Collection getFavouriter()    Returns the current record's "Favouriter" collection
 * @method Doctrine_Collection getOrganiser()     Returns the current record's "Organiser" collection
 * @method Doctrine_Collection getSpeaker()       Returns the current record's "Speaker" collection
 * @method Doctrine_Collection getWatcher()       Returns the current record's "Watcher" collection
 * @method Event               setConferenceId()  Sets the current record's "conference_id" value
 * @method Event               setTagline()       Sets the current record's "tagline" value
 * @method Event               setDate()          Sets the current record's "date" value
 * @method Event               setLocationId()    Sets the current record's "location_id" value
 * @method Event               setDescription()   Sets the current record's "description" value
 * @method Event               setUrl()           Sets the current record's "url" value
 * @method Event               setImage()         Sets the current record's "image" value
 * @method Event               setIcon()          Sets the current record's "icon" value
 * @method Event               setHashtag()       Sets the current record's "hashtag" value
 * @method Event               setAddress()       Sets the current record's "address" value
 * @method Event               setPostcode()      Sets the current record's "postcode" value
 * @method Event               setConference()    Sets the current record's "Conference" value
 * @method Event               setLocation()      Sets the current record's "Location" value
 * @method Event               setAttending()     Sets the current record's "Attending" collection
 * @method Event               setFavouriters()   Sets the current record's "Favouriters" collection
 * @method Event               setOrganisers()    Sets the current record's "Organisers" collection
 * @method Event               setSpeakers()      Sets the current record's "Speakers" collection
 * @method Event               setWatchers()      Sets the current record's "Watchers" collection
 * @method Event               setPresentations() Sets the current record's "Presentations" collection
 * @method Event               setAttendee()      Sets the current record's "Attendee" collection
 * @method Event               setFavouriter()    Sets the current record's "Favouriter" collection
 * @method Event               setOrganiser()     Sets the current record's "Organiser" collection
 * @method Event               setSpeaker()       Sets the current record's "Speaker" collection
 * @method Event               setWatcher()       Sets the current record's "Watcher" collection
 * 
 * @package    speakr
 * @subpackage model
 * @author     Steve Lacey
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('event');
        $this->hasColumn('conference_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '20',
             ));
        $this->hasColumn('tagline', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('location_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '20',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('image', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('icon', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('hashtag', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('address', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('postcode', 'string', 8, array(
             'type' => 'string',
             'length' => '8',
             ));

        $this->option('orderBy', 'date ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Conference', array(
             'local' => 'conference_id',
             'foreign' => 'id'));

        $this->hasOne('Location', array(
             'local' => 'location_id',
             'foreign' => 'id'));

        $this->hasMany('sfGuardUser as Attending', array(
             'refClass' => 'Attendee',
             'local' => 'event_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUser as Favouriters', array(
             'refClass' => 'Favouriter',
             'local' => 'event_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUser as Organisers', array(
             'refClass' => 'Organiser',
             'local' => 'event_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUser as Speakers', array(
             'refClass' => 'Speaker',
             'local' => 'event_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUser as Watchers', array(
             'refClass' => 'Watcher',
             'local' => 'event_id',
             'foreign' => 'user_id'));

        $this->hasMany('Presentation as Presentations', array(
             'local' => 'id',
             'foreign' => 'event_id'));

        $this->hasMany('Attendee', array(
             'local' => 'id',
             'foreign' => 'event_id'));

        $this->hasMany('Favouriter', array(
             'local' => 'id',
             'foreign' => 'event_id'));

        $this->hasMany('Organiser', array(
             'local' => 'id',
             'foreign' => 'event_id'));

        $this->hasMany('Speaker', array(
             'local' => 'id',
             'foreign' => 'event_id'));

        $this->hasMany('Watcher', array(
             'local' => 'id',
             'foreign' => 'event_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}