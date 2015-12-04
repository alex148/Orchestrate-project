<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:23
 */

namespace website\CoreBundle\Model;


class Invitation implements \JsonSerializable
{

    private $key;

    private $user_from_key;

    private $user_to_key;

    private $message;

    public function jsonSerialize() {
        return [
            'key' => $this->key,
            'user_from_key' => $this->user_from_key,
            'user_to_key' => $this->user_to_key,
            'message' => $this->message
        ];
    }

    public static function kvObjectToDetail($kvObject){
        if($kvObject == null || $kvObject->getKey() == null){
            return null;
        }
        try{
            $array = $kvObject->getValue();
            $detail = new Detail();
            $detail->setKey($kvObject->getKey());
            if(array_key_exists('data', $array) && $array['data'] != null){
                $detail->setData($array['data']);
            }
            return $detail;
        }catch(Exception $e){

        }
        return null;
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
    public function getUserFromKey()
    {
        return $this->user_from_key;
    }

    /**
     * @param mixed $user_from_key
     */
    public function setUserFromKey($user_from_key)
    {
        $this->user_from_key = $user_from_key;
    }

    /**
     * @return mixed
     */
    public function getUserToKey()
    {
        return $this->user_to_key;
    }

    /**
     * @param mixed $user_to_key
     */
    public function setUserToKey($user_to_key)
    {
        $this->user_to_key = $user_to_key;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


}