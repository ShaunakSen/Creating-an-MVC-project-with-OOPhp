<?php
//Start Session

session_start();

//Include Config
require('config.php');
require('classes/bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');
require('classes/Messages.php');

require('controllers/Home.php');
require('controllers/Users.php');
require('controllers/Shares.php');

require('models/Home.php');
require('models/User.php');
require('models/Share.php');


$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
    $controller->extecuteAction();
}