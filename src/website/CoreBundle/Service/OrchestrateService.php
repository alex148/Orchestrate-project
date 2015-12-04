<?php
/**
 * Created by Alexandre Brosse
 * Date: 10/11/2015
 * Time: 17:44
 */

namespace website\CoreBundle\Service;

use SocalNick\Orchestrate\Client;
use SocalNick\Orchestrate\Exception\ClientException;
use SocalNick\Orchestrate\KvPutOperation;
use SocalNick\Orchestrate\KvPostOperation;
use SocalNick\Orchestrate\KvFetchOperation;
use SocalNick\Orchestrate\KvDeleteOperation;
use SocalNick\Orchestrate\SearchOperation;
use SocalNick\Orchestrate\GraphFetchOperation;
use SocalNick\Orchestrate\GraphPutOperation;
use SocalNick\Orchestrate\GraphDeleteOperation;
use Symfony\Component\Config\Definition\Exception\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class OrchestrateService
{

    private $orchestrate;
    private $logger;

    public function __construct($orchestrate_api_key,Logger $logger)
    {
        try {
            $this->orchestrate = new Client($orchestrate_api_key);
            $this->logger = $logger;
        }catch(Exception $e){
            $logger->error($e->getMessage());
        }catch(ClientException $e){
            $logger->error($e->getMessage());
        }

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
        $this->logger->debug('put an object with the key ['.$key.'] in the collection ['.$collection.']');
        try {
            $this->logger->info('Create PutOperation');
            $putOp = new kvPutOperation($collection, $key, json_encode($object,JSON_PRETTY_PRINT));
            $result = $this->orchestrate->execute($putOp);
            $this->logger->debug('Put Successful [ref : '.$result->getRef().' ]');
            return true;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
            $this->logger->error($e->getMessage());
        }
        return false;
    }

    /**
     * Used to post an object in a collection with an auto-generated key
     * @param $collection : collection used to post an object in
     * @param $object : object to post
     * @return auto-generated key or null
     */
    public function Post($collection, $object){
        $this->logger->debug('put an object in the collection ['.$collection.']');
        try{
            $postOp = new kvPostOperation($collection,json_encode($object,JSON_PRETTY_PRINT));
            $result = $this->orchestrate->execute($postOp);
            return $result->getKey();
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
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
        $this->logger->debug('get an object with the key ['.$key.'] in the collection ['.$collection.']');
        try{
            $getOp = new KvFetchOperation($collection,$key);
            $result = $this->orchestrate->execute($getOp);
            return $result;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    /**
     * Used to delete an object from a collection
     * @param $collection : object's collection
     * @param $key : key of the object to delete
     * @param $purge : if true, permanently removes data from the database
     * @return true if deleted else false
     */
    public function Delete($collection, $key, $purge = null){
        $this->logger->debug('delete an object with the key ['.$key.'] from the collection ['.$collection.'] with purge ['.$purge.']');
        try{
            if($purge != null){
                $deleteOp = new KvDeleteOperation($collection, $key, $purge);
            }else{
                $deleteOp = new KvDeleteOperation($collection, $key);
            }
            return $this->orchestrate->execute($deleteOp);
        }catch(Exception $e){
                $this->logger->error($e->getMessage());
        }catch(ClientException $e){
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
        $this->logger->debug('search an object in the collection ['.$collection.']
        with query ['.$query.'] limit ['.$limit.'] offset ['.$offset.'] sort ['.$sort.']');
        try{
            $searchOp = new SearchOperation($collection,$query, $limit, $offset, $sort);
            $searchResult = $this->orchestrate->execute($searchOp);
            if($searchResult->count() > 0){
                return $searchResult->getValue()['results'];
            }
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    /**
     *
     * Used to get links from an object
     * @param $collection : object's collection
     * @param $key : object's key
     * @param $relationship : relationship type
     * @param $limit : could be null
     * @param $offset : could be null
     * @return array of results or null
     */
    public function GetLinks($collection, $key, $relationship, $limit=null, $offset=null){
        $this->logger->debug('get links in the collection ['.$collection.']
        for the key ['.$key.']  with the relationship ['.$relationship.'] limit ['.$limit.'] offset ['.$offset.']');
        try{
            if($limit != null && $offset != null){
                $graphFetchOp = new GraphFetchOperation($collection,$key,$relationship,$limit, $offset);
                $graphResult = $this->orchestrate->execute($graphFetchOp);
            }else{
                $graphFetchOp = new GraphFetchOperation($collection,$key,$relationship);
                $graphResult = $this->orchestrate->execute($graphFetchOp);
            }

            return $graphResult;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
            $this->logger->error($e->getMessage());
        }
        return null;
    }

    /**
     *
     * Used to add a link between 2 objects from collections
     * @param $collectionSource
     * @param $keySource
     * @param $relationship
     * @param $collectionToAdd
     * @param $keyToAdd
     * @return true or false
     */
    public function AddLink($collectionSource, $keySource, $relationship, $collectionToAdd, $keyToAdd){
        $this->logger->debug('add the link ['.$collectionToAdd.']['.$keyToAdd.'] in the collection ['.$collectionSource.']
        for the key ['.$keySource.']  with the relationship ['.$relationship.']');
        try{
            $graphPutOp = new GraphPutOperation($collectionSource, $keySource, $relationship, $collectionToAdd, $keyToAdd);
            $result = $this->orchestrate->execute($graphPutOp);
            return $result;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
            $this->logger->error($e->getMessage());
        }
        return false;
    }

    /**
     *
     * Used to delete a link between 2 objects from collections
     * @param $collectionSource
     * @param $keySource
     * @param $relationship
     * @param $collectionToDelete
     * @param $keyToDelete
     * @return true or false
     */
    public function DeleteLink($collectionSource, $keySource, $relationship, $collectionToDelete, $keyToDelete){
        $this->logger->debug('remove the link ['.$collectionToDelete.']['.$keyToDelete.'] in the collection ['.$collectionSource.']
        for the key ['.$keySource.']  with the relationship ['.$relationship.']');
        try{
            $graphDeleteOp = new GraphDeleteOperation($collectionSource, $keySource, $relationship, $collectionToDelete, $keyToDelete);
            $result = $this->orchestrate->execute($graphDeleteOp);
            return $result;
        }catch(Exception $e){
            $this->logger->error($e->getMessage());
        }catch(ClientException $e){
            $this->logger->error($e->getMessage());
        }
        return false;
    }
}