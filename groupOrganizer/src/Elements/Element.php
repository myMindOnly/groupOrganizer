<?php

/*
 * This file is part of the groupOrganizer.
 * 
 * (c) Osama Agha <osama.agha24@gmail.com>
 * and open the template in the editor.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GOrganizer\Elements;

use GOrganizer\Redis\Construct;
use GOrganizer\Groups\Group;
use GOrganizer\Mongo;


/**
 * Description of Member
 *
 * @author Osama Agha <osama.agha24@gmail.com>
 */
class Element extends Construct
{

    public $mongo;

    /**
     * 
     * @param type $userId arg can be db index or user id 
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    function __construct($userId = NULL)
    {

        if (!empty($userId) && DISTRIBUTE_DATA_BY_USERID) {
            $db = substr($userId, 0, 1);
        } else {
            $db = REDIS_GROUP_DATABASE;
        }

        // Let the parent handle construction. 
        parent::__construct($db);
        $this->mongo = new Mongo();
    }

    /**
     * 
     * @return \self
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public static function getInstance($userId = NULL)
    {
        return new self($userId);
    }

    /**
     * 
     * @param type $userId
     * @param type $element
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addElement($userId, $element)
    {
        $this->redisKey->elementIdCounter($userId);
        $elementId = $this->redis->iNcr($this->redisKey->getKey());

        $m = new MongoClient();
        $element['userId'] = $userId;
        $element['elementId'] = $elementId;
        echo "Connection to database successfully";
        // select a database
        $db = $this->mongo->groupOrganizer;
        echo "<pre>";
        print_r($db);
        die('hehehe');
        echo "Database mydb selected";
        $collection = $db->element;
        echo "Collection selected succsessfully";

        $collection->insert($element);
    }

    /**
     * 
     * @param type $userId
     * @param type $element
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addElementRedis($userId, $element)
    {
        $this->redisKey->elementIdCounter($userId);
        $elementId = $this->redis->iNcr($this->redisKey->getKey());

        $this->redisKey->element($userId, $elementId);
        $element['elementId'] = $elementId;
        $this->redis->hMSet($this->redisKey->getKey(), $element);
        return $elementId;
    }

    /**
     * 
     * @param type $userId
     * @param type $groupName
     * @param type $elementObject
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addElementWithObject($userId, $groupName, $elementObject = array())
    {
        $elementId = Element::getInstance($userId)->addElement($userId, $elementObject);
        Group::getInstance($userId)->addGroupAndElement($userId, $elementId, $groupName);
    }

    /**
     * 
     * @param type $groupName
     * @param type $elementObject
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addGeneralElementWithObject($groupName, $elementObject = array())
    {
        $this->addElementWithObject($userId = NULL, $groupName, $elementObject);
    }

    /**
     * 
     * @param type $userId
     * @param type $elementId
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function deleteElement($userId, $elementId)
    {
        $this->redisKey->element($userId, $elementId);
        return $this->redis->delete($this->redisKey->getKey());
    }

    /**
     * 
     * @param type $userId
     * @param type $elements
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function getElements($userId, $elements = array())
    {
        $this->redis->multi();
        foreach ($elements as $elementId) {
            $this->redisKey->element($userId, $elementId);
            $this->redis->hGetAll($this->redisKey->getKey());
        }
        return $this->redis->exec();
    }

}
