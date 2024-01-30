<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/includes/useage.php";
$obj = new Useage();
$obj->setting_response('teams', "1");
// $obj->setting_response('persons', "44");


