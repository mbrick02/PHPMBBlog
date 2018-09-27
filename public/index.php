<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 );
// require_once( "sample..php" );
// err not in php.ini for linux DEL for Win

require_once('../private/initialize.php');
// ** replace above with: require __DIR__ . '/../bootstrap/app.php';
$app->run();
?>
