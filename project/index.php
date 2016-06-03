<?php
//Include Config
require('config.php');
require('classes/bootstrap.php');
require('classes/Controller.php');
require('controllers/Home.php');
require('controllers/Users.php');
require('controllers/Shares.php');


$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
    $controller->extecuteAction();
}