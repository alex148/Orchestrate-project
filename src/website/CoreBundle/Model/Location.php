<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 03/12/2015
 * Time: 22:22
 */

namespace website\CoreBundle\Model;


class Location implements \JsonSerializable
{

    private $latitude;
    private $longitude;

    public function __construct()
    {
        $this->latitude = 0;
        $this->longitude = 0;
    }

    public function jsonSerialize() {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
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
     * @return int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param int $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }




}