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

namespace GOrganizer\Redis;

use GOrganizer\Redis\KeyAttribute;

/**
 * Description of GenerateRedisKey
 *
 * @author Osama Agha <osama.agha24@gmail.com>
 */
class GenerateRedisKey
{

    public $key;

    /**
     * 
     * @param type $userId
     * @param type $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function groupElement($userId, $groupName)
    {
        $this->key = NULL;
        $this->buildKey(KeyAttribute::GROUPROOT);
        $this->buildUserIdKey($userId);
        $this->buildKey(KeyAttribute::GROUPSNAME);
        $this->buildKey($groupName);
    }

    /**
     * 
     * @param type $userId
     * @param type $groupName
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function groupElementTmp($userId, $groupName)
    {
        $this->key = NULL;
        $this->buildKey(KeyAttribute::GROUPROOT);
        $this->buildUserIdKey($userId);
        $this->buildKey(KeyAttribute::GROUPSNAMETMP);
        $this->buildKey($groupName);
    }

    /**
     * 
     * @param type $userId
     * @param type $elmentId
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function elementResidesInGroups($userId, $elmentId)
    {
        $this->key = NULL;
        $this->buildKey(KeyAttribute::GROUPROOT);
        $this->buildUserIdKey($userId);
        $this->buildKey(KeyAttribute::ELEMENTRESIDES);
        $this->buildKey($elmentId);
    }

    /**
     * 
     * @param type $userId
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function groupList($userId)
    {
        $this->key = NULL;
        $this->buildKey(KeyAttribute::GROUPROOT);
        $this->buildUserIdKey($userId);
        $this->buildKey(KeyAttribute::GROUPLIST);
    }

    /**
     * 
     * @param type $userId
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function element($userId, $idCounter)
    {
        $this->key = NULL;
        $this->buildKey(KeyAttribute::ELEMENTROOT);
        $this->buildUserIdKey($userId);
        $this->buildKey(KeyAttribute::ELEMENID);
        $this->buildKey($idCounter);
    }

    /**
     * 
     * @param type $userId
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function elementIdCounter($userId)
    {
        $this->key = NULL;
        $this->buildKey(KeyAttribute::ELEMENTROOT);
        $this->buildUserIdKey($userId);
        $this->buildKey(KeyAttribute::ELEMENCOUNTER);
    }

    /**
     * 
     * @param type $keyPart
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function buildKey($keyPart)
    {
        if (!empty($keyPart)) {
            if (empty($this->key)) {
                $this->key = $keyPart;
            } else {
                $this->key .= KeyAttribute::KEYGLUE . $keyPart;
            }
        } else {
            die('error $keyPart');
        }
    }

    /**
     * 
     * @param type $userId
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function buildUserIdKey($userId)
    {
        if (GENERAT_EKEYS_WITH_USERID) {
            //        die(substr($userId, 0,1));
            if (!empty($userId)) {
                $this->key .= KeyAttribute::KEYGLUE . KeyAttribute::USERID
                        . KeyAttribute::KEYGLUE . $userId;
            }
        }
    }

    /**
     * 
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function getKey()
    {
        return $this->key;
    }

}
