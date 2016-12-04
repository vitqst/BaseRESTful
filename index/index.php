<?php
require __DIR__ . '/../Core/RestServer/RestServer.php';
require '../Controller/Demo_Controller.php' ;
require '../Controller/User_Controller.php' ;
require 'config/config.php' ;
$server = new Jacwright\RestServer\RestServer('debug');
$server->addClass('DemoController');
$server->addClass('UserController');
$server->handle();