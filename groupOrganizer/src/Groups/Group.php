<?php

/*
 * This file is part of the Predis groupOrganizer.
 * 
 * (c) Osama Agha <osama.agha24@gmail.com>
 * and open the template in the editor.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GOrganizer\Groups;

use GOrganizer\Redis\Construct;
use GOrganizer\Elements\Element;

/**
 * Description of group
 *
 * @author  Osama Agha <osama.agha24@gmail.com>
 */
class Group extends Construct
{
    /**
     * 
     * @param type $userId arg can be db index or user id 
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
    }

    /**
     * 
     * @return \GOrganizer\Groups\Group
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public static function getInstance($userId = NULL)
    {
        return new self($userId);
    }

    /**
     * 
     * @param int/string $userId
     * @param string $groupName
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addGroupName($userId, $groupName)
    {
        $this->redisKey->groupList($userId);
        return $this->specialCommand->addValueToZSet($this->redisKey->getKey(), $groupName);
    }

    /**
     * 
     * @param int/string $userId
     * @param string $elementId
     * @param string $groupName
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addElementIntoGroup($userId, $elementId, $groupName)
    {
        $this->redisKey->groupElement($userId, $groupName);
        return $this->specialCommand->addValueToZSet($this->redisKey->getKey(), $elementId);
    }

    /**
     * 
     * @param int/string $userId
     * @param string $elementId
     * @param string $groupName
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addElementResidesInGroups($userId, $elementId, $groupName)
    {
        $this->redisKey->elementResidesInGroups($userId, $elementId);
        return $this->specialCommand->addValueToZSet($this->redisKey->getKey(), $groupName);
    }

    /**
     * 
     * @param int/string $userId
     * @param string $elementId
     * @param string $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addGroupAndElement($userId, $elementId, $groupName)
    {
        $this->addGroupName($userId, $groupName);
        $this->addElementIntoGroup($userId, $elementId, $groupName);
        $this->addElementResidesInGroups($userId, $elementId, $groupName);
    }

    /**
     * 
     * @param int/string $userId
     * @param array of string $groups
     * @param int $offset
     * @param int $count
     * @param bool $withscores
     * @param int $start
     * @param int $end
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function getMutualGroupsElement($userId, $groups = array(), $offset = 0, $count = 10, $withscores = false, $start = '+inf', $end = '-inf')
    {
        $groupsKeys = array();
        $groupsString = NULL;

        foreach ($groups as $groupName) {
            $this->redisKey->groupElement($userId, $groupName);
            $groupsKeys[] = $this->redisKey->getKey();
            $groupsString.=$groupName . "_";
        }
        $this->redisKey->groupElementTmp($userId, $groupsString);
        $this->redis->zInterStore($this->redisKey->getKey(), $groupsKeys);
        return $this->redis->zRevrangeByScore($this->redisKey->getKey(), $start, $end, $withscores, $offset, $count);
    }

    /**
     * 
     * @param int/string $userId
     * @param array of string $groups
     * @param int $offset
     * @param int $count
     * @param bool $withscores
     * @param int $start
     * @param int $end
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function getGroupsElement($userId, $groups = array(), $offset = 0, $count = 10, $withscores = false, $start = '+inf', $end = '-inf')
    {
        $groupsKeys = array();
        $groupsString = NULL;

        foreach ($groups as $groupName) {
            $this->redisKey->groupElement($userId, $groupName);
            $groupsKeys[] = $this->redisKey->getKey();
            $groupsString.=$groupName . "_";
        }
        $this->redisKey->groupElementTmp($userId, $groupsString);
        $this->redis->zUnionStore($this->redisKey->getKey(), $groupsKeys);
        return $this->redis->zRevrangeByScore($this->redisKey->getKey(), $start, $end, $withscores, $offset, $count);
    }

    /**
     * 
     * @param type $userId
     * @param type $elementId
     * @param type $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function removeElementFromGroup($userId, $elementId, $groupName)
    {
        $this->redisKey->groupElement($userId, $groupName);
        $this->redis->zRem($this->redisKey->getKey(), $elementId);
    }

    /**
     * 
     * @param int/string $userId
     * @param string $elementId
     * @param string $groupName
     * @return array
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function removeElementResides($userId, $elementId, $groupName)
    {
        $this->redisKey->elementResidesInGroups($userId, $elementId);
        $this->redis->zRem($this->redisKey->getKey(), $groupName);
    }

    /**
     * 
     * @param type $userId
     * @param type $elementId
     * @param type $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function removeElementFromGroupAndResides($userId, $elementId, $groupName)
    {
        $this->removeElementFromGroup($userId, $elementId, $groupName);
        $this->removeElementResides($userId, $elementId, $groupName);
    }

    /**
     * 
     * @param type $userId
     * @param type $elementId
     * @param type $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function deleteElementFromGroupAndResides($userId, $elementId, $groupName)
    {
        $this->removeElementFromGroupAndResides($userId, $elementId, $groupName);
        Element::getInstance()->deleteElement($userId, $elementId);
    }

    /**
     * 
     * @param type $userId
     * @param type $elementId
     * @param type $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function removeElementFromAllGroupAndResides($userId, $elementId)
    {
        $this->redisKey->elementResidesInGroups($userId, $elementId);
        $elementInGroups = $this->redis->zRange($this->redisKey->getKey());
        $this->redis->multi();
        foreach ($elementInGroups as $groupName) {
            $this->removeElementFromGroupAndResides($userId, $elementId, $groupName);
        }
        $result = $this->redis->exec();
        return $result;
    }

}
