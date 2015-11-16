<?php
/**
 * Created by Alexandre Brosse
 * Date: 10/11/2015
 * Time: 17:44
 */

namespace website\CoreBundle\Service;

use SocalNick\Orchestrate\Client;
use SocalNick\Orchestrate\KvPutOperation;
use SocalNick\Orchestrate\KvPostOperation;
use SocalNick\Orchestrate\KvFetchOperation;
use SocalNick\Orchestrate\KvDeleteOperation;
use SocalNick\Orchestrate\SearchOperation;
use Symfony\Component\Config\Definition\Exception\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class OrchestrateService
{

    private $orchestrate;
    private $logger;

    public function __construct($orchestrate_api_key,Logger $logger)
    {
        $this->orchestrate = new Client($orchestrate_api_key);
        $this->logger = $logger;

    }

    /**
     * Used to update an object in a collection
     * @param $collection : collection containing the object to update
     * @param $key : object key
     * @param $object : new version of the object
     * @return object reference or null
     */
    public function Put($collection, $key, $object)
    {
        try {
            $this->logger->info('Create PutOperation');
            $putOp = new kvPutOperation($collection, $key, json_encode($object,JSON_PRETTY_PRINT));
            $result = $this->orchestrate->execute($putOp);
            $this->logger->info('Put Successful [ref : '.$result->getRef().' ]');
            return $result->getRef();
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    /**
     * Used to post an object in a collection with an auto-generated key
     * @param $collection : collection used to post an object in
     * @param $object : object to post
     * @return auto-generated key or null
     */
    public function Post($collection, $object){
        try{
            $this->logger->info('Create PostOperation');
            $postOp = new kvPostOperation($collection,json_encode($object,JSON_PRETTY_PRINT));
            $result = $this->orchestrate->execute($postOp);
            $this->logger->info('Post Successful [key : '.$result->getRef().' ]');
            return $result->getKey();
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    /**
     * Used to get an object from a collection by key
     * @param $collection : collection used to get an object from
     * @param $key : key to get
     * @return object or null
     */
    public function Get($collection, $key){
        try{
            $this->logger->info('Create GetOperation');
            $getOp = new KvFetchOperation($collection,$key);
            $result = $this->orchestrate->execute($getOp);
            $this->logger->info('Get Successful');
            return $result->getValue();
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    /**
     * Used to delete an object from a collection
     * @param $collection : object's collection
     * @param $key : key of the object to delete
     * @param $purge : if true, permanently removes data from the database
     * @return true if deleted false else
     */
    public function Delete($collection, $key, $purge = null){
        try{
            if($purge != null){
                $deleteOp = new KvDeleteOperation($collection, $key, $purge);
            }else{
                $deleteOp = new KvDeleteOperation($collection, $key);
            }
             return $this->orchestrate->execute($deleteOp);
           }catch(Exception $e){
                $this->logger->error($e->getMessage());
           }
        return false;
    }

    /**
     * Used to search objects in a collection
     * @param $collection : objects collection
     * @param $query : filtre's query
     * @param $limit : number max of results
     * @param $offset :
     * @param $sort  : asc / desc
     * @return array of results or null
     */
    public function Search($collection, $query, $limit,$offset, $sort){
        try{
            $searchOp = new SearchOperation($collection,$query, $limit, $offset, $sort);
            $searchResult = $this->orchestrate->execute($searchOp);
           // $total = $searchResult->totalCount(); // 8
            if($searchResult->count() > 0){
                return $searchResult->getValue()['results'];
            }
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }
}