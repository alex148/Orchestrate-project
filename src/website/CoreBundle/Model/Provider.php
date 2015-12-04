<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:24
 */

namespace website\CoreBundle\Model;


class Provider
{
    private $key;

    private $name;

    private $adr_key;

    private $category_key;

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
    public function getCategoryKey()
    {
        return $this->category_key;
    }

    /**
     * @param mixed $category_key
     */
    public function setCategoryKey($category_key)
    {
        $this->category_key = $category_key;
    }

    /**
     * @return mixed
     */
    public function getAdrKey()
    {
        return $this->adr_key;
    }

    /**
     * @param mixed $adr_key
     */
    public function setAdrKey($adr_key)
    {
        $this->adr_key = $adr_key;
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