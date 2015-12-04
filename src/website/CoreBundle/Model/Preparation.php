<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:23
 */

namespace website\CoreBundle\Model;


class Preparation implements \JsonSerializable
{

    private $key;

    private $event_key;

    private $user_key;

    private $label;

    public function jsonSerialize() {
        return [
            'key' => $this->key,
            'event_key' => $this->event_key,
            'user_key' => $this->user_key,
            'label' => $this->label
        ];
    }

    public static function kvObjectToPreparation($kvObject){
        if($kvObject == null || $kvObject->getKey() == null){
            return null;
        }
        try{
            $array = $kvObject->getValue();
            $preference = new Preference();
            $preference->setKey($kvObject->getKey());
            if(array_key_exists('user_key', $array) && $array['user_key'] != null){
                $preference->setUserKey($array['user_key']);
            }
            if(array_key_exists('language_key', $array) && $array['language_key'] != null){
                $preference->setLanguage($array['language_key']);
            }
            return $preference;
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
    public function getEventKey()
    {
        return $this->event_key;
    }

    /**
     * @param mixed $event_key
     */
    public function setEventKey($event_key)
    {
        $this->event_key = $event_key;
    }

    /**
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->user_key;
    }

    /**
     * @param mixed $user_key
     */
    public function setUserKey($user_key)
    {
        $this->user_key = $user_key;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }


}