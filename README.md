PHP group organizer based on redis database 

====================
usage

1- Download group organizer package 
	https://codeload.github.com/oagha/groupOrganizer/zip/master

2- unzip file 
	unzip groupOrganizer-XXX.zip

3- go to the package directory 
	cd groupOrganizer

4- use Predis from this project or use your own predis from your project
	https://github.com/nrk/predis

5- in case you want to use your own predis lib go to autoload file and change predis dir
	groupOrganizer/groupOrganizer/autoload.php

6- add loader in your project 
	require 'groupOrganizer/autoload.php';
	use GOrganizer\Groups\Group;
	use GOrganizer\Elements\Element;


