<?php
// bin\apache\apache2.4.23\conf\extra\httpd-vhosts.conf set to phpmbblog.org:8080
/* *** Turn PHP error on *************/
// phpinfo(); /// see PHP ini location and other info

error_reporting( E_ALL );
ini_set( "display_errors", 1 );
// err not in php.ini for linux DEL for Win

require_once('../private/initialize.php');

$app->run();
// $app->config('debug', true); // see FirePHP in MB Blog (or xdebug) 11/5/18

?>
