<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:24
 */

namespace website\CoreBundle\Model;


class Participation implements \JsonSerializable
{

    private $key;

    private $user_key;

    private $event_key;

    private $state_key;

    private $isPayed;

    private $payement_date;

    private $payement_reference;

    private $amount;

    private $date;

    public function jsonSerialize() {
        return [
            'key' => $this->key,
            'user_key' => $this->user_key,
            'event_key' => $this->event_key,
            'state_key' => $this->state_key,
            'isPayed' => $this->isPayed,
            'payement_date' => $this->payement_date,
            'amount' => $this->amount,
            'date' => $this->date
        ];
    }

    public static function kvObjectToParticipation($kvObject){
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
    public function getStateKey()
    {
        return $this->state_key;
    }

    /**
     * @param mixed $state_key
     */
    public function setStateKey($state_key)
    {
        $this->state_key = $state_key;
    }

    /**
     * @return mixed
     */
    public function getIsPayed()
    {
        return $this->isPayed;
    }

    /**
     * @param mixed $isPayed
     */
    public function setIsPayed($isPayed)
    {
        $this->isPayed = $isPayed;
    }

    /**
     * @return mixed
     */
    public function getPayementDate()
    {
        return $this->payement_date;
    }

    /**
     * @param mixed $payement_date
     */
    public function setPayementDate($payement_date)
    {
        $this->payement_date = $payement_date;
    }

    /**
     * @return mixed
     */
    public function getPayementReference()
    {
        return $this->payement_reference;
    }

    /**
     * @param mixed $payement_reference
     */
    public function setPayementReference($payement_reference)
    {
        $this->payement_reference = $payement_reference;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }





}