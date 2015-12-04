<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:24
 */

namespace website\CoreBundle\Model;


class Event implements \JsonSerializable
{

    private $key;

    private $popularity;

    private $organizer_key;

    private $title;

    private $description;

    private $date;

    private $duration;

    private $participation_max;

    private $participation_min;

    private $perimeter;

    private $adr_key;

    private $state_key;

    private $category_key;

    private $isFree;

    private $type_payement_key;

    private $asPreparation;

    private $creation_date;

    private $provider_key;

    private $notes;

    private $latitude;

    private $longitude;

    public function jsonSerialize() {
        return [
            'key' => $this->key,
            'popularity' => $this->popularity,
            'organizer_key' => $this->organizer_key,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'duration' => $this->duration,
            'participation_max' => $this->participation_max,
            'participation_min' => $this->participation_min,
            'perimeter' => $this->perimeter,
            'adr_key' => $this->adr_key,
            'state_key' => $this->state_key,
            'category_key' => $this->category_key,
            'isFree' => $this->isFree,
            'type_payement_key' => $this->type_payement_key,
            'asPreparation' => $this->asPreparation,
            'creation_date' => $this->creation_date,
            'provider_key' => $this->provider_key,
            'notes' => $this->notes,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    public static function kvObjectToCategory($kvObject){
        if($kvObject == null || $kvObject->getKey() == null){
            return null;
        }
        try{
            $array = $kvObject->getValue();
            $category = new Category();
            $category->setKey($kvObject->getKey());
            if(array_key_exists('parent_key', $array) && $array['parent_key'] != null){
                $category->setParentKey($array['parent_key']);
            }
            if(array_key_exists('parent_key', $array) && $array['parent_key'] != null){
                $category->setCategoryKey($array['parent_key']);
            }
            return $category;
        }catch(Exception $e){

        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @param mixed $popularity
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;
    }

    /**
     * @return mixed
     */
    public function getOrganizerKey()
    {
        return $this->organizer_key;
    }

    /**
     * @param mixed $organizer_key
     */
    public function setOrganizerKey($organizer_key)
    {
        $this->organizer_key = $organizer_key;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getParticipationMax()
    {
        return $this->participation_max;
    }

    /**
     * @param mixed $participation_max
     */
    public function setParticipationMax($participation_max)
    {
        $this->participation_max = $participation_max;
    }

    /**
     * @return mixed
     */
    public function getParticipationMin()
    {
        return $this->participation_min;
    }

    /**
     * @param mixed $participation_min
     */
    public function setParticipationMin($participation_min)
    {
        $this->participation_min = $participation_min;
    }

    /**
     * @return mixed
     */
    public function getPerimeter()
    {
        return $this->perimeter;
    }

    /**
     * @param mixed $perimeter
     */
    public function setPerimeter($perimeter)
    {
        $this->perimeter = $perimeter;
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
    public function getStateKey()
    {
        return $this->state_key;
    }

    /**
     * @param mixed $state_key
     */
    public function setStateKey($state_key)
    {
        $this->state_key = $state_key;
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
    public function getIsFree()
    {
        return $this->isFree;
    }

    /**
     * @param mixed $isFree
     */
    public function setIsFree($isFree)
    {
        $this->isFree = $isFree;
    }

    /**
     * @return mixed
     */
    public function getTypePayementKey()
    {
        return $this->type_payement_key;
    }

    /**
     * @param mixed $type_payement_key
     */
    public function setTypePayementKey($type_payement_key)
    {
        $this->type_payement_key = $type_payement_key;
    }

    /**
     * @return mixed
     */
    public function getAsPreparation()
    {
        return $this->asPreparation;
    }

    /**
     * @param mixed $asPreparation
     */
    public function setAsPreparation($asPreparation)
    {
        $this->asPreparation = $asPreparation;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return mixed
     */
    public function getProviderKey()
    {
        return $this->provider_key;
    }

    /**
     * @param mixed $provider_key
     */
    public function setProviderKey($provider_key)
    {
        $this->provider_key = $provider_key;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }


}