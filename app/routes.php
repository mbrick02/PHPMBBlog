<?php

// ***APPARENTLY YOU CAN ONLY AUTOLOAD CLASSES
// see my_autoload in intialize.php
/* function route_autoload($route) {
  if(preg_match('/\A\w+\Z/', $route)) {
      require_once('routes/' . strtolower($route) . '.php');
  } // had to use strtolower -- for some reason linux (only) would cap Session
}
spl_autoload_register('route_autoload'); */

$app->get('/', 'HomeController:index');

/* ***NOTE all post route controllers must do token check:
if(Token::check($_POST['token'])) {
  echo 'Process order';
}
*/

require_once('Routes/Products.php');
