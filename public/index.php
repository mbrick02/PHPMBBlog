<?php
/* *** Turn PHP error on *************/
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
// err not in php.ini for linux DEL for Win


require_once('../private/initialize.php');

$app->run();
?>
