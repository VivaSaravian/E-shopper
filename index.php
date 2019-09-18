<?php 

//FRONT CONTROLLER


//General settings


session_start();

//Connect to file system
define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Autoload.php');



//Connect to database

//Call Router
$router = new Router();
$router->run();