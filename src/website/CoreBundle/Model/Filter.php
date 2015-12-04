<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:23
 */

namespace website\CoreBundle\Model;


class Filter implements \JsonSerializable
{
    private $key;

    private $perimeter;

    private $date_min;

    private $date_max;

    private $hour_min;

    private $hour_max;

    private $duration;

    private $participant_num_min;

    private $participant_num_max;

    private $city;

    private $organized_by_friend;

    private $friend_participation;

    private $match;

    public function jsonSerialize() {
        return [
            'key' => $this->key,
            'perimeter' => $this->perimeter,
            'date_min' => $this->date_min,
            'date_max' => $this->date_max,
            'hour_min' => $this->hour_min,
            'hour_max' => $this->hour_max,
            'duration' => $this->duration,
            'participant_num_min' => $this->participant_num_min,
            'participant_num_max' => $this->participant_num_max,
            'city' => $this->city,
            'organized_by_friend' => $this->organized_by_friend,
            'friend_participation' => $this->friend_participation,
            'match' => $this->match
        ];
    }

    public static function kvObjectToFilter($kvObject){
        if($kvObject == null || $kvObject->getKey() == null){
            return null;
        }
        try{
            $array = $kvObject->getValue();
            $filter = new Filter();
            $filter->setKey($kvObject->getKey());
            if(array_key_exists('perimeter', $array) && $array['perimeter'] != null){
                $filter->setPerimeter($array['perimeter']);
            }
            if(array_key_exists('date_min', $array) && $array['date_min'] != null){
                $filter->setDateMin($array['date_min']);
            }
            if(array_key_exists('date_max', $array) && $array['date_max'] != null){
                $filter->setDateMax($array['date_max']);
            }
            if(array_key_exists('hour_min', $array) && $array['hour_min'] != null){
                $filter->setHourMin($array['hour_min']);
            }
            if(array_key_exists('hour_max', $array) && $array['hour_max'] != null){
                $filter->setHourMax($array['hour_max']);
            }
            if(array_key_exists('duration', $array) && $array['duration'] != null){
                $filter->setDuration($array['duration']);
            }
            if(array_key_exists('participant_num_min', $array) && $array['participant_num_min'] != null){
                $filter->setParticipantNumMin($array['participant_num_min']);
            }
            if(array_key_exists('participant_num_max', $array) && $array['participant_num_max'] != null){
                $filter->setParticipantNumMax($array['participant_num_max']);
            }
            if(array_key_exists('city', $array) && $array['city'] != null){
                $filter->setCity($array['city']);
            }
            if(array_key_exists('organized_by_friend', $array) && $array['organized_by_friend'] != null){
                $filter->setOrganizedByFriend($array['organized_by_friend']);
            }
            if(array_key_exists('friend_participation', $array) && $array['friend_participation'] != null){
                $filter->setFriendParticipation($array['friend_participation']);
            }
            if(array_key_exists('match', $array) && $array['match'] != null){
                $filter->setMatch($array['match']);
            }
            return $filter;
        }catch(Exception $e){

        }
        return null;
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
    public function getDateMin()
    {
        return $this->date_min;
    }

    /**
     * @param mixed $date_min
     */
    public function setDateMin($date_min)
    {
        $this->date_min = $date_min;
    }

    /**
     * @return mixed
     */
    public function getDateMax()
    {
        return $this->date_max;
    }

    /**
     * @param mixed $date_max
     */
    public function setDateMax($date_max)
    {
        $this->date_max = $date_max;
    }

    /**
     * @return mixed
     */
    public function getHourMin()
    {
        return $this->hour_min;
    }

    /**
     * @param mixed $hour_min
     */
    public function setHourMin($hour_min)
    {
        $this->hour_min = $hour_min;
    }

    /**
     * @return mixed
     */
    public function getHourMax()
    {
        return $this->hour_max;
    }

    /**
     * @param mixed $hour_max
     */
    public function setHourMax($hour_max)
    {
        $this->hour_max = $hour_max;
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
    public function getParticipantNumMin()
    {
        return $this->participant_num_min;
    }

    /**
     * @param mixed $participant_num_min
     */
    public function setParticipantNumMin($participant_num_min)
    {
        $this->participant_num_min = $participant_num_min;
    }

    /**
     * @return mixed
     */
    public function getParticipantNumMax()
    {
        return $this->participant_num_max;
    }

    /**
     * @param mixed $participant_num_max
     */
    public function setParticipantNumMax($participant_num_max)
    {
        $this->participant_num_max = $participant_num_max;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getOrganizedByFriend()
    {
        return $this->organized_by_friend;
    }

    /**
     * @param mixed $organized_by_friend
     */
    public function setOrganizedByFriend($organized_by_friend)
    {
        $this->organized_by_friend = $organized_by_friend;
    }

    /**
     * @return mixed
     */
    public function getFriendParticipation()
    {
        return $this->friend_participation;
    }

    /**
     * @param mixed $friend_participation
     */
    public function setFriendParticipation($friend_participation)
    {
        $this->friend_participation = $friend_participation;
    }

    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param mixed $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }


}