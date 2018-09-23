<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 );
// require_once( "sample..php" );
// err not in php.ini for linux DEL for Win

// Slim framework
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

require_once('../private/initialize.php');

$app = new \Slim\App;

require_once('../app/api/products.php');

$app->run();
?>
