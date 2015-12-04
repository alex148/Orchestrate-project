<?php
/**
 * Created by Alexandre Brosse
 * Date: 12/11/2015
 * Time: 12:29
 */

namespace website\CoreBundle\Model;


use Symfony\Component\Config\Definition\Exception\Exception;
use website\CoreBundle\Model\Address;

class User implements \JsonSerializable
{

    public static $collection = 'User';

    private $key;

    private $name;

    private $firstName;

    private $password;

    private $mail;

    private $birthDate;

    private $photo;

    private $description;

    private $location;

    private $creationDate;


    /**
     * @Object Address
     */
    private  $address;
    /**
     * @List<User>
     */
    private $friends;
    /**
     * @List<Filter>
     */
    private $filters;

    /**
     * @Object Preference
     */
    private $preference;
    /**
     * @List<Note>
     */
    private $notes;

    /**
     * @List<Participation>
     */
    private $participations; //todo check the way to get partcipation

    /**
     * @var Detail
     */
    private $detail;

    /**
     * @List<Invitation>
     */
    private $invitations;

    /**
     * User constructor.
     */
    public function __construct()
    {
        //TODO tout mettre à null
        $this->name = 'Brosse';
        $this->firstName = 'Alexandre';
        $this->password = '123456';
        $this->mail = 'alex148@hotmail.fr';
        $this->birthDate = date_create('1993-01-25');
        $this->photo = 'ceci sera une photo';
        $this->description = 'date = salut moi c\'est alexandre ça farte?';
        $this->location = new Location();
        $this->address = new Address();
        $this->friends = null;
        $this->filters = null;
        $this->preference = new Preference();
        $this->notes = null;
        $this->participations = null;
        $this->detailKey = new Detail();
        $this->invitations = null;
    }



    public function jsonSerialize() {
      return [
                'name' => $this->name,
                'firstName' => $this->firstName,
                'password'=> $this->password,
                'mail' => $this->mail,
                'birthDate' => $this->birthDate,    //todo check date format
                'photo' => $this->photo,
                'description' => $this->description,
                'location' => $this->location,
                'address' => $this->address
      ];
    }


    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $adr
     */
    public function setAddress($adr)
    {
        $this->address = $adr;
    }

    /**
     * @return mixed
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param mixed $friends
     */
    public function setFriends($friends)
    {
        $this->friends = $friends;
    }

    /**
     * @param $friend
     */
    public function addFriend($friend){
            if($this->friends == null)
                $this->friends = [];
            array_push($this->friends, $friend);
    }

    public function hasFriend($friend){
        if($this->friends == null)
            $this->friends = [];
        if(in_array($friend,$this->friends,true)){
            return true;
        }
        return false;
    }

    /**
     * @param $user
     * @return bool
     */
    public function removeFriend($user){
        if($user != null && $user instanceof User && $this->friends != null){
            if(in_array($user,$this->friends)){
            $arrayKey = array_search($user,$this->friends,'strict');
            }
            unset($this->friends[$arrayKey]);
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param mixed $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    /**
     * @return mixed
     */
    public function getPreference()
    {
        return $this->preference;
    }

    /**
     * @param mixed $preference
     */
    public function setPreference($preference)
    {
        $this->preference = $preference;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getParticipations()
    {
        return $this->participations;
    }

    /**
     * @param mixed $participations
     */
    public function setParticipations($participations)
    {
        $this->participations = $participations;
    }

    /**
     * @return mixed
     */
    public function getInvitations()
    {
        return $this->invitations;
    }

    /**
     * @param mixed $invitations
     */
    public function setInvitations($invitations)
    {
        $this->invitations = $invitations;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }


}