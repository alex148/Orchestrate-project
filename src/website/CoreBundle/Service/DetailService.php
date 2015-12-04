<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 29/11/2015
 * Time: 20:12
 */

namespace website\CoreBundle\Service;

use Monolog\Logger;
use website\CoreBundle\Model\Detail;

class DetailService
{
    private $logger;
    private $orchestrate;

    public function __construct(Logger $logger, $orchestrate)
    {
        $this->logger = $logger;
        $this->orchestrate = $orchestrate;
    }

    public function postDetail($detail){
        $key = $this->orchestrate->Post("Detail",$detail);
        return $key;
    }

    public function updateDetail($detail){
        $this->orchestrate->Put("Detail",$detail);
    }

    public function getDetail($key){
        $kvObject = $this->orchestrate->Get("Detail",$key);
        if($kvObject != null)
            return $this->kvObjectToDetail($kvObject);
        return null;
    }

    public function kvObjectToDetail($kvObject){
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
            $this->logger->error($e->getMessage());
        }
        return null;
    }

}