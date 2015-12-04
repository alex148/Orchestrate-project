<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:25
 */

namespace website\CoreBundle\Model;


class Preference implements \JsonSerializable
{

    private $key;

    private $language;

    public function __construct()
    {
        $this->key = null;
        $this->language = 'FR';
    }

    public function jsonSerialize() {
        return [
            'language' => $this->language
        ];
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
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }


}