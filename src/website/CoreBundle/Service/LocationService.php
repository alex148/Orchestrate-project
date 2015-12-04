<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 03/12/2015
 * Time: 23:48
 */

namespace website\CoreBundle\Service;

use Monolog\Logger;
use website\CoreBundle\Model\Location;

class LocationService
{

    private $logger;
    private $orchestrate;

    public function __construct(Logger $logger, $orchestrate)
    {
        $this->logger = $logger;
        $this->orchestrate = $orchestrate;
    }

    public function arrayToLocation($array){
        if($array == null){
            return null;
        }
        try{
            $location = new Location();
            if(array_key_exists('latitude', $array) && $array['latitude'] != null){
                $location->setLatitude($array['latitude']);
            }
            if(array_key_exists('longitude', $array) && $array['longitude'] != null){
                $location->setLongitude($array['longitude']);
            }
            return $location;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }
}