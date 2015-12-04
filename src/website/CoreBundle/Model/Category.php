<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alexandre Brosse
 * Date: 22/11/2015
 * Time: 22:24
 */

namespace website\CoreBundle\Model;


class Category implements \JsonSerializable
{

    private $key;

    private $parent_key;

    private $category_key;

    public function jsonSerialize() {
    return [
        'key' => $this->key,
        'parent_key' => $this->parent_key,
        'category_key' => $this->category_key
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
    public function getParentKey()
    {
        return $this->parent_key;
    }

    /**
     * @param mixed $parent_key
     */
    public function setParentKey($parent_key)
    {
        $this->parent_key = $parent_key;
    }


}