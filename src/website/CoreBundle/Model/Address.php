<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:36
 */

namespace website\CoreBundle\Model;


class Address implements \JsonSerializable
{


    private $name;

    private $line1;

    private $line2;

    private $zipCode;

    private $city;

    public function __construct()
    {
        $this->name = null;
        $this->line1 = null;
        $this->line2 = null;
        $this->zipCode = null;
        $this->city = null;
    }

    public function jsonSerialize() {
        return [
            'name' => $this->name,
            'line1' => $this->line1,
            'line2'=> $this->line2,
            'zipCode' => $this->zipCode,
            'city' => $this->city
        ];
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
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * @param mixed $line1
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;
    }

    /**
     * @return mixed
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * @param mixed $line2
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }


}