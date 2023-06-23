<?php

/**
 *  /var/www/html
 *  /var/www/smarty
 *  /var/www/vendor
 */

require_once(__DIR__."/../vendor/smarty/smarty/libs/Smarty.class.php");


/** 
 *  Define a global object smarty; 
 *  it is now accessible throughout the project 
 * */
$smarty = new Smarty();


/** templates directory is placed in the project's root */
$smarty->setTemplateDir(__DIR__."/templates");


/** Smarty config files are located in smarty directory */
$smarty->setCacheDir(__DIR__."/../smarty/cache");
$smarty->setConfigDir(__DIR__."/../smarty/configs");
$smarty->setCompileDir(__DIR__."/../smarty/templates_c");

//$smarty->testInstall();
//$smarty->debugging = true;