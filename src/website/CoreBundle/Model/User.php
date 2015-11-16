<?php
/**
 * Created by Alexandre Brosse
 * Date: 12/11/2015
 * Time: 12:29
 */

namespace website\CoreBundle\Model;


class User implements \JsonSerializable
{

    public static $collection = 'User';

    private $key;

    private $name;

    private $first_name;

    private $login;

    private $password;

    private $location;

    public function __construct()
    {
        $this->name = 'test2';
        $this->first_name = 'toto3';
        $this->login = 'toto03';
        $this->password = 'password';
        $this->location = new Location(4.7,4.9);
    }


    public function jsonSerialize() {
      return [
              'name' => $this->name,
              'first_name' => $this->first_name,
              'login' => $this->login,
              'password'=> $this->password,
              'location' => $this->location
      ];
    }

    public static function arrayToUsers($array){
        $user = new User();
        if(array_key_exists('name', $array) && $array['name'] != null){
            $user->setName($array['name']);
        }
        if(array_key_exists('first_name', $array) && $array['first_name'] != null){
            $user->setFirstName($array['first_name']);
        }
        if(array_key_exists('login', $array) && $array['login'] != null){
            $user->setPassword($array['login']);
        }
        if(array_key_exists('password', $array) && $array['password'] != null){
            $user->setPassword($array['password']);
        }
        if(array_key_exists('location', $array) && $array['location'] != null){
            $user->setLocation(new Location($array['location']['latitude'],$array['location']['longitude']));
        }
        return $user;
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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
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


}