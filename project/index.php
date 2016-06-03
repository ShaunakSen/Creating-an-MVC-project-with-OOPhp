<?php
//Include Config
require('config.php');
require('classes/bootstrap.php');
$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();