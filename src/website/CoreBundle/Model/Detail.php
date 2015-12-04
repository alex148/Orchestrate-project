<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:23
 */

namespace website\CoreBundle\Model;


class Detail implements \JsonSerializable
{

    private $key;

    private $data;

    public function __construct()
    {
        $this->key = null;
        $this->data = "encrypted data";
    }

    public function jsonSerialize() {
        return [
            'data' => $this->data
        ];
    }


}