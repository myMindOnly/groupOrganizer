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

/**
 * Description of attribute
 *
 * @author  Osama Agha <osama.agha24@gmail.com>
 */
abstract class KeyAttribute
{

    const KEYGLUE = ":";
    const GROUPROOT = "groups";
    const GROUPLIST = "groupList";
    const GROUPSNAME = "groupName";
    const GROUPSNAMETMP = "groupNameTmp";
    const ELEMENTRESIDES = "elementInGroups";
    const USERID = "userId";
    const ELEMENTROOT = "elements";
    const ELEMENID = "elementId";
    const ELEMENCOUNTER = "idCounter";

    //put your code here
}
