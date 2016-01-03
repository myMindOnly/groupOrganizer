<?php

require '../groupOrganizer/autoload.php';

use GOrganizer\Groups\Group;
use GOrganizer\Elements\Element;

function addElementAction()
{
    $groupsNameTmp = !empty($_REQUEST['groupName']) ? $_REQUEST['groupName'] : '';
    $elementObject['name'] = !empty($_REQUEST['name']) ? $_REQUEST['name'] : '';
    $elementObject['userName'] = !empty($_REQUEST['userName']) ? $_REQUEST['userName'] : '';
    $elementObject['mobile'] = !empty($_REQUEST['mobile']) ? $_REQUEST['mobile'] : '';
    $elementObject['email'] = !empty($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $elementObject['gender'] = !empty($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
    $Element = new Element();
    $groupsName = explode(',', $groupsNameTmp);
    foreach ($groupsName as $groupName) {
        $Element->addGeneralElementWithObject($groupName, $elementObject);
    }
}

function getMutualElementAction()
{
    $groups[] = !empty($_REQUEST['groupName1']) ? $_REQUEST['groupName1'] : '';
    $groups[] = !empty($_REQUEST['groupName2']) ? $_REQUEST['groupName2'] : '';
    $groups[] = !empty($_REQUEST['groupName3']) ? $_REQUEST['groupName3'] : '';

    $Group = new Group();
    $groups = $Group->getGeneralMutualGroupsElement($groups);
    die(json_encode($groups));
}

function startAction($val)
{
    die($val);
}
