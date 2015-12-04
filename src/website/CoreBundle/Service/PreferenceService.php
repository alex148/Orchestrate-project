<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre
 * Date: 29/11/2015
 * Time: 20:03
 */

namespace website\CoreBundle\Service;

use Monolog\Logger;
use website\CoreBundle\Model\Preference;

class PreferenceService
{

    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function arrayToPreference($array){
        if($array == null){
            return null;
        }
        try{
            $preference = new Preference();
            if(array_key_exists('language', $array) && $array['language'] != null){
                $preference->setLanguage($array['language']);
            }
            return $preference;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }
}