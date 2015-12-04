<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:25
 */

namespace website\CoreBundle\Model;


class Note_Event implements \JsonSerializable
{
    private $key;

    private $user_from_key;

    private $event_to_key;

    private $note;

    public function jsonSerialize() {
        return [
            'key' => $this->key,
            'user_from_key' => $this->user_from_key,
            'event_to_key' => $this->event_to_key,
            'note' => $this->note
        ];
    }

    public static function kvObjectToNoteEvent($kvObject){
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
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getEventToKey()
    {
        return $this->event_to_key;
    }

    /**
     * @param mixed $event_to_key
     */
    public function setEventToKey($event_to_key)
    {
        $this->event_to_key = $event_to_key;
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



}