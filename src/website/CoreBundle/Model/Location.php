<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 12/11/2015
 * Time: 12:31
 */

namespace website\CoreBundle\Model;


class Location implements \JsonSerializable
{
    private $key;

    private $latitude;

    private $longitude;

    public function __construct($latitude, $longitude)
    {

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function jsonSerialize() {
        return [
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude()
        ];
    }

    public static function arrayToLocation($array){

        if($array != null){

        }
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
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

}