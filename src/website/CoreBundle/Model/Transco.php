<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:24
 */

namespace website\CoreBundle\Model;


class Transco
{

    private $key;

    private $label_FR;

    private $label_EN;

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
    public function getLabelEN()
    {
        return $this->label_EN;
    }

    /**
     * @param mixed $label_EN
     */
    public function setLabelEN($label_EN)
    {
        $this->label_EN = $label_EN;
    }

    /**
     * @return mixed
     */
    public function getLabelFR()
    {
        return $this->label_FR;
    }

    /**
     * @param mixed $label_FR
     */
    public function setLabelFR($label_FR)
    {
        $this->label_FR = $label_FR;
    }


}