<?php

require 'groupOrganizer/autoload.php';

use GOrganizer\Groups\Group;
use GOrganizer\Elements\Element;

$Group = new Group(111);
$Element = new Element(111);

//Element::getInstance(1111)->addElementWithObject(1111, 'group1', array("key1"=>'val1',"key2"=>'val2'));


$userId = 1111;
$v = $member->getMutualGroupsElement($userId, $groups);
$rrr = \GOrganizer\Elements\Element::getInstance(111)->getElements(1111, $v);

$groups = array("group1", "group2");
$userId = 1212;
$v = $member->getMutualGroupsElement($userId, $groups);
