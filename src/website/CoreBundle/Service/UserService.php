<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 26/11/2015
 * Time: 17:56
 */

namespace website\CoreBundle\Service;

use Monolog\Logger;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Constraints\DateTime;
use website\CoreBundle\Model\Address;
use website\CoreBundle\Model\Location;
use website\CoreBundle\Model\User;

class UserService
{

    private $logger;
    private $orchestrate;
    private $addressService;
    private $preferenceService;
    private $detailService;
    private $locationService;
    private $collection = 'User';
    private $friendRelation = 'Friend';

    /**
     * UserService constructor.
     * @param Logger $logger
     * @param $orchestrate
     * @param AddressService $addressService
     * @param PreferenceService $preferenceService
     * @param DetailService $detailService
     * @param LocationService $locationService
     */
    public function __construct(Logger $logger, $orchestrate,AddressService $addressService,
                                PreferenceService $preferenceService, DetailService $detailService,
                                LocationService $locationService)
    {
        $this->logger = $logger;
        $this->orchestrate = $orchestrate;
        $this->addressService = $addressService;
        $this->preferenceService = $preferenceService;
        $this->detailService = $detailService;
        $this->locationService = $locationService;
    }

    /**
     * @param User $user
     * @return user key
     */
    public function createUser(User $user){
        $this->logger->debug('User creation');
        $key = $this->orchestrate->Post($this->collection,$user);
        return $key;
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function updateUser(User $user){
        $this->logger->debug('Update of user ['.$user->getKey().']');
        return $this->orchestrate->Put($this->collection,$user->getKey(),$user);
    }

    /**
     * @param String $key
     * @return null|User
     */
    public function getUser($key){
        $this->logger->debug('get user ['.$key.']');
        $kvObject = $this->orchestrate->Get($this->collection,$key);
        if($kvObject != null)
            return $this->kvObjectToUser($kvObject);
        return null;
    }

    /**
     * @param User $user
     * @param User $friend
     * @return bool
     */
    public function addFriend(User $user, User $friend){
        $this->logger->debug('User ['.$user->getKey().'] add ['.$friend->getKey().'] as friend');
        if(!$user->hasFriend($friend)){

            $result = $this->orchestrate->AddLink($this->collection, $user->getKey(), $this->friendRelation, $this->collection, $friend->getKey());
            if($result)
                $result = $this->orchestrate->AddLink($this->collection, $friend->getKey(), $this->friendRelation, $this->collection, $user->getKey());
            if($result)
                $user->addFriend($this->kvObjectToUser($this->orchestrate->Get($this->collection, $friend->getKey())));
            return $result;
        }
        return false;
    }

    /**
     * @param User $user
     * @param User $friend
     * @return mixed
     */
    public function removeFriend(User $user, User $friend){
        $this->logger->debug('User ['.$user->getKey().'] removes the friend ['.$friend->getKey().']');
            if($user->hasFriend()){
            $result = $this->orchestrate->DeleteLink($this->collection, $user->getKey(), $this->friendRelation, $this->collection, $friend->getKey());
            if($result)
                $result = $this->orchestrate->DeleteLink($this->collection, $friend->getKey(), $this->friendRelation, $this->collection, $user->getKey());
            if($result)
                $user->removeFriend($friend);
            return $result;
            }
        return false;
    }


    public function getFriends(User $user){
        $kvList = $this->orchestrate->GetLinks($this->collection, $user->getKey(), $this->friendRelation);
        $result = $kvList->getValue();
        $friends = $result['results'];
        $user->setFriends($this->kvListToUserList($friends));
    }

    public function kvListToUserList(array $kvList){
        $list = [];
        if($kvList == null || count($kvList) <= 0){
            return null;
        }
        foreach($kvList as $kvObject){
            $user= new User();
            $user->setKey($kvObject['path']['key']);
            $this->addUserComponents($user,$kvObject['value']);
            array_push($list,$user);
        }
        return $list;

    }
    /**
     * @param $kvObject
     * @return null|User
     */
    public function kvObjectToUser($kvObject){
        if($kvObject == null || $kvObject->getKey() == null){
            return null;
        }
        try{
            ////////////////////////////simple components///////////////////////////////
            $array = $kvObject->getValue();
            $user = new User();
            $user->setKey($kvObject->getKey());
            $this->addUserComponents($user,$array);
            //friends
            $user->setFriends($this->getFriends($user));
            //filters

            //notes

            //participations

            //detail

            //invitation

            return $user;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    public function addUserComponents($user,$array){
        //todo set creation date
        if(array_key_exists('name', $array) && $array['name'] != null){
            $user->setName($array['name']);
        }
        if(array_key_exists('firstName', $array) && $array['firstName'] != null){
            $user->setFirstName($array['firstName']);
        }
        if(array_key_exists('password', $array) && $array['password'] != null){
            $user->setPassword($array['password']);
        }
        if(array_key_exists('mail', $array) && $array['mail'] != null){
            $user->setMail($array['mail']);
        }
        if(array_key_exists('birthDate', $array) && $array['birthDate'] != null){
            //$user->setBirthDate(date_format((string)$array['birthDate'], 'Y-m-d H:i:s')); //todo check date format
            $user->setBirthDate($array['birthDate']);
        }
        if(array_key_exists('photo', $array) && $array['photo'] != null){
            $user->setPhoto($array['photo']);   //todo finalize
        }
        if(array_key_exists('description', $array) && $array['description'] != null){
            $user->setDescription($array['description']);
        }
        ////////////////////////////object components///////////////////////////////
        if(array_key_exists('location', $array) && $array['location'] != null ){
            $user->setLocation($this->locationService->arrayToLocation($array['location']));
        }
        if(array_key_exists('address', $array) && $array['address'] != null){
            $user->setAddress($this->addressService->arrayToAddress($array['address']));
        }
        if(array_key_exists('preference', $array) && $array['preference'] != null){
            $user->setPreference($this->preferenceService->arrayToPreference($array['preference']));
        }
    }
}