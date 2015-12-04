<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 26/11/2015
 * Time: 18:24
 */

namespace website\CoreBundle\Service;

use Monolog\Logger;
use website\CoreBundle\Model\Address;


class AddressService
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }


    public function arrayToAddress($array){
        if($array == null){
            return null;
        }
        try{
            $address = new Address();
            if(array_key_exists('name', $array) && $array['name'] != null){
                $address->setName($array['name']);
            }
            if(array_key_exists('line1', $array) && $array['line1'] != null){
                $address->setLine1($array['line1']);
            }
            if(array_key_exists('line2', $array) && $array['line2'] != null){
                $address->setLine2($array['line2']);
            }
            if(array_key_exists('zipCode', $array) && $array['zipCode'] != null){
                $address->setZipCode($array['zipCode']);
            }
            if(array_key_exists('city', $array) && $array['city'] != null){
                $address->setCity($array['city']);
            }
            return $address;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }
}